<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddEmployeeDetailsRequest;
use App\Http\Requests\EmployeeDetailsRequest;
use App\Models\AddressDetail;
use App\Models\AddressType;
use App\Models\Country;
use App\Models\Designation;
use App\Models\District;
use App\Models\EmployeeDetail;
use App\Models\EmployeeSalaryBreakUp;
use App\Models\EmployeeStatus;
use App\Models\SalaryComponentType;
use App\Models\SalaryType;
use App\Models\State;
use App\Models\User;
use App\Models\UserRole;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function getMasterData()
    {
        try {
            return Response()->json([
                "status" => true, "message" => "Master Data retrived successfully",
                "data" => [
                    "designations" => Designation::getDesignation(),
                    "states" => State::getStateList(),
                    "countries" => Country::getCountryList(),
                    "districts" => District::getDistrictList()
                ]
            ]);
        } catch (Exception $e) {

            return Response()->json(["status" => false, "message" => $e->getMessage(), "data" => null]);
        }
    }

    public function addEmployee(AddEmployeeDetailsRequest $request)
    {

        try {

            $basicDetails = $request->employee_details;
            $addressDetails = $request->address_details;
            $salaryDetails = $request->salary_details;

            DB::beginTransaction();

            $employee = $this->addEmployeeDetails($basicDetails);

            $this->addAddress($addressDetails, $employee->id);
            $this->addSalary($salaryDetails, $employee->id);

            DB::commit();
            return Response()->json(["status" => true, "message" => ' Employee added successfully', "data" => null]);
        } catch (Exception $e) {

            DB::rollBack();
            return Response()->json(["status" => false, "message" => $e->getMessage(), "data" => null]);
        }
    }

    private function addEmployeeDetails($employeeDetails)
    {

        $employee = new EmployeeDetail();

        $employee->designation_id = $employeeDetails['designation_id'];
        $employee->employee_status_id = EmployeeStatus::ACTIVE;
        $employee->phone_number = $employeeDetails['phone_no'];
        $employee->first_name = $employeeDetails['first_name'];
        $employee->last_name = $employeeDetails['last_name'];

        $employee->save();

        $user = new User();
        $user->user_role_id = UserRole::EMPLOYEE;
        $user->name = $employeeDetails['first_name'] . " " . $employeeDetails['last_name'];
        $user->email = $employeeDetails['email'];
        $user->password = bcrypt('Employee@123');
        $user->save();

        return $employee;
    }

    private function addAddress($address, $employeeId)
    {

        $this->addIndivisualAddress(AddressType::PERMANET, $address['permanent_address'], $employeeId);
        $this->addIndivisualAddress(AddressType::CURRENT, $address['current_address'], $employeeId);
    }

    private function addIndivisualAddress($addressType, $addressDetails, $employeeId)
    {

        $address = new AddressDetail();

        $address->employee_id = $employeeId;
        $address->address_type_id = $addressType;
        $address->country_id = $addressDetails['country_id'];
        $address->state_id = $addressDetails['state_id'];
        $address->district_id = $addressDetails['district_id'];
        $address->land_mark = $addressDetails['land_mark'];
        $address->house_name = $addressDetails['house_name'];

        $address->save();
    }

    private function addSalary($salary, $employeeId)
    {

        $this->addEarnings($salary['earning'], $employeeId);
        $this->AddDeduction($salary['deduction'], $employeeId);
    }

    private function addEarnings($earning, $employeeId)
    {


        $createdAt = Carbon::now();

        $earningSalary = [
            ['employee_id' => $employeeId, 'salary_type_id' => SalaryType::EARNING, 'salary_component_id' => SalaryComponentType::BASIC_PAY, 'amount' => $earning['basic_pay'], 'status' => true, 'created_at' => $createdAt, 'updated_at' => $createdAt],
            ['employee_id' => $employeeId, 'salary_type_id' => SalaryType::EARNING, 'salary_component_id' => SalaryComponentType::HRA, 'amount' => $earning['hra'], 'status' => true, 'created_at' => $createdAt, 'updated_at' => $createdAt],
            ['employee_id' => $employeeId, 'salary_type_id' => SalaryType::EARNING, 'salary_component_id' => SalaryComponentType::CCA, 'amount' => $earning['cca'], 'status' => true, 'created_at' => $createdAt, 'updated_at' => $createdAt]
        ];

        EmployeeSalaryBreakUp::insert($earningSalary);
    }

    private function AddDeduction($deduction, $employeeId)
    {


        $createdAt = Carbon::now();

        $deductionSalary = [
            ['employee_id' => $employeeId, 'salary_type_id' => SalaryType::DEDUCTION, 'salary_component_id' => SalaryComponentType::PT, 'amount' => $deduction['pt'], 'status' => true, 'created_at' => $createdAt, 'updated_at' => $createdAt],
            ['employee_id' => $employeeId, 'salary_type_id' => SalaryType::DEDUCTION, 'salary_component_id' => SalaryComponentType::IT, 'amount' => $deduction['it'], 'status' => true, 'created_at' => $createdAt, 'updated_at' => $createdAt],

        ];

        EmployeeSalaryBreakUp::insert($deductionSalary);
    }

    public function getAllEmployeeDetails()
    {
        try {
            $employeeDetails = EmployeeDetail::select('*')
                ->where('status', true)
                ->with('status')
                ->with('designation')
                ->with(['salary' => function ($query) {
                    $query->selectRaw('employee_id, 
            SUM(CASE WHEN salary_type_id = 1 THEN amount ELSE 0 END) - SUM(CASE WHEN salary_type_id = 2 THEN amount ELSE 0 END) AS net')
                        ->groupBy('employee_id');
                }])

                ->get()->toArray();
            return Response()->json(["status" => true, "message" => 'Employee details retrived successfully', "data" => $employeeDetails]);
        } catch (Exception $e) {

            return Response()->json(["status" => false, "message" => $e->getMessage(), "data" => null]);
        }
    }

    public function getEmployeeDetails(EmployeeDetailsRequest $request)
    {
        try {
            $employeeId = $request->employee_id;
            $employeeDeatilsById = EmployeeDetail::select('*')
                ->where('id', $employeeId)
                ->where('status', true)
                ->with('designation')
                ->with(['salary' => function ($query) {
                    $query->selectRaw('employee_id, 
            sum(case when salary_component_id = 1 then amount else 0 end) as basic_pay,sum(case when salary_component_id = 2 then amount else 0 end) as HRA ,sum(case when salary_component_id = 3 then amount else 0 end) as CCA,sum(case when salary_component_id = 4 then amount else 0 end) as PT ,sum(case when salary_component_id = 5 then amount else 0 end) as IT ,SUM(CASE WHEN salary_type_id = 1 THEN amount ELSE 0 END) - SUM(CASE WHEN salary_type_id = 2 THEN amount ELSE 0 END) AS net')
                        ->groupBy('employee_id');
                }])
                ->with(['address' => function ($query) {
                    $query->with('addressType');
                    $query->with('country');
                    $query->with('state');
                    $query->with('district');
                }])
                ->get()->toArray();



            return Response()->json(["status" => true, "message" => 'Employee details retrived successfully', "data" => $employeeDeatilsById]);
        } catch (Exception $e) {

            return Response()->json(["status" => false, "message" => $e->getMessage(), "data" => null]);
        }
    }
}
