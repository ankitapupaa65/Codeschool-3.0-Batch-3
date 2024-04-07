<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AddressDetail;
use App\Models\AddressType;
use App\Models\Country;
use App\Models\Designation;
use App\Models\District;
use App\Models\EmployeeDetail;
use App\Models\EmployeeStatus;
use App\Models\SalaryComponentType;
use App\Models\SalaryType;
use App\Models\State;
use App\Models\User;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $createdAt = Carbon::now();



        $country = [['country_name' => 'India', 'created_at' => $createdAt, 'updated_at' => $createdAt], ['country_name' => 'Japan', 'created_at' => $createdAt, 'updated_at' => $createdAt]];

        Country::insert($country);

        $state = [
            ['country_id' => 1, 'state_name' => 'Telegana', 'created_at' => $createdAt, 'updated_at' => $createdAt],
            ['country_id' => 1, 'state_name' => 'Odisha', 'created_at' => $createdAt, 'updated_at' => $createdAt],
            ['country_id' => 1, 'state_name' => 'WestBangal', 'created_at' => $createdAt, 'updated_at' => $createdAt]
        ];

        State::insert($state);
        $district = [
            ['state_id' => 1, 'district_name' => 'Siddipet'],
            ['state_id' => 1, 'district_name' => 'Jagtial'],
            ['state_id' => 2, 'district_name' => 'Puri'],
            ['state_id' => 2, 'district_name' => 'Khordha'],
            ['state_id' => 3, 'district_name' => 'Kolkata']
        ];
        District::insert($district);

        $userRole = [
            ['id' => UserRole::ADMIN, 'user_role' => 'Admin', 'created_at' => $createdAt, 'updated_at' => $createdAt],
            ['id' => UserRole::EMPLOYEE, 'user_role' => 'Employee', 'created_at' => $createdAt, 'updated_at' => $createdAt]
        ];
        UserRole::insert($userRole);


        $password = bcrypt('Employee@123');

        $user = [
            ['email' => 'admin@gmail.com', 'user_role_id' => UserRole::ADMIN, 'name' => 'Admin', 'password' => $password, 'created_at' => $createdAt, 'updated_at' => $createdAt],
            ['email' => 'emp@gmail.com', 'user_role_id' => UserRole::EMPLOYEE, 'name' => 'Employee', 'password' => $password, 'created_at' => $createdAt, 'updated_at' => $createdAt]

        ];
        User::insert($user);
        $empStatus = [
            ['id' => EmployeeStatus::ACTIVE, 'status_name' => 'Active', 'created_at' => $createdAt, 'updated_at' => $createdAt],
            ['id' => EmployeeStatus::INACTIVE, 'status_name' => 'Inactive', 'created_at' => $createdAt, 'updated_at' => $createdAt],
            ['id' => EmployeeStatus::BLOCKED, 'status_name' => 'Blocked', 'created_at' => $createdAt, 'updated_at' => $createdAt]
        ];
        EmployeeStatus::insert($empStatus);
        $designation = [
            ['id' => Designation::MANAGER, 'designation_name' => 'Manger', 'created_at' => $createdAt, 'updated_at' => $createdAt],
            ['id' => Designation::TECHLEAD,  'designation_name' => 'TechLead', 'created_at' => $createdAt, 'updated_at' => $createdAt],
            ['id' => Designation::DEVEOLPER, 'designation_name' => 'Developer', 'created_at' => $createdAt, 'updated_at' => $createdAt]
        ];
        Designation::insert($designation);
        // $employeeDetails = [
        //     ['first_name' => 'john', 'last_name' => 'doe', 'phone_number' => '6737964834', 'designation_id' => Designation::DEVEOLPER, 'employee_status_id' => EmployeeStatus::ACTIVE, 'created_at' => $createdAt, 'updated_at' => $createdAt],
        //     ['first_name' => 'smith', 'last_name' => 'donor', 'phone_number' => '6874567878', 'designation_id' => Designation::TECHLEAD, 'employee_status_id' => EmployeeStatus::ACTIVE, 'created_at' => $createdAt, 'updated_at' => $createdAt],
        //     ['first_name' => 'juli', 'last_name' => 'anna', 'phone_number' => '8965534578', 'designation_id' => Designation::MANAGER, 'employee_status_id' => EmployeeStatus::INACTIVE, 'created_at' => $createdAt, 'updated_at' => $createdAt]
        // ];

        // EmployeeDetail::insert($employeeDetails);

        $addressType = [
            ['id' => AddressType::CURRENT, 'address_name' => 'Current Address', 'created_at' => $createdAt, 'updated_at' => $createdAt],
            ['id' => AddressType::PERMANET, 'address_name' => 'Permanet Address', 'created_at' => $createdAt, 'updated_at' => $createdAt]
        ];
        AddressType::insert($addressType);
        // $addressDetails = [
        //     [
        //         'employee_id' => 1, 'address_type_id' => AddressType::CURRENT, 'country_id' => 1, 'state_id' => 1,
        //         'district_id' => '1', 'land_mark' => 'madhapur', 'house_name' => 'white buliding'
        //     ],
        //     [
        //         'employee_id' => 1, 'address_type_id' => AddressType::PERMANET, 'country_id' => 1, 'state_id' => 1,
        //         'district_id' => '2',
        //         'land_mark' => 'solepur', 'house_name' => 'black buliding'
        //     ], [
        //         'employee_id' => 2, 'address_type_id' => AddressType::CURRENT, 'country_id' => 1, 'state_id' => 1,
        //         'district_id' => '3', 'land_mark' => 'madhapur', 'house_name' => 'white buliding'
        //     ],
        //     [
        //         'employee_id' => 2, 'address_type_id' => AddressType::PERMANET, 'country_id' => 1, 'state_id' => 3,
        //         'district_id' => '4', 'land_mark' => 'mitapur', 'house_name' => 'red buliding'
        //     ],
        //     [
        //         'employee_id' => 3, 'address_type_id' => AddressType::CURRENT, 'country_id' => 1, 'state_id' => 1,
        //         'district_id' => '3', 'land_mark' => 'madhapur', 'house_name' => 'white buliding'
        //     ],
        //     [
        //         'employee_id' => 3, 'address_type_id' => AddressType::PERMANET, 'country_id' => 4, 'state_id' => 3,
        //         'district_id' => '1', 'land_mark' => 'sikila', 'house_name' => 'gk buliding'
        //     ]
        // ];
        // AddressDetail::insert($addressDetails);
        $salaryType = [
            ['id' => SalaryType::EARNING, 'salary_types' => 'Earning'],
            ['id' => SalaryType::DEDUCTION, 'salary_types' => 'Deduction']
        ];
        SalaryType::insert($salaryType);
        $salaryComponentType = [
            ['salary_type_id' => SalaryType::EARNING, 'components_name' => 'Basic pay'],
            ['salary_type_id' => SalaryType::EARNING, 'components_name' => ' HRA'],
            ['salary_type_id' => SalaryType::EARNING, 'components_name' => ' CCA'],
            ['salary_type_id' => SalaryType::DEDUCTION, 'components_name' => ' PT'],
            ['salary_type_id' => SalaryType::DEDUCTION, 'components_name' => ' IT']
        ];
        SalaryComponentType::insert($salaryComponentType);
        // $salaryBreakUp = [
        //     [
        //         'employee_id' => 1, 'salary_type_id' => SalaryType::EARNING,
        //         'salary_component_id' => 1, 'amount' => 30000
        //     ],
        //     [
        //         'employee_id' => 1, 'salary_type_id' => SalaryType::EARNING,
        //         'salary_component_id' => 2, 'amount' => 15000
        //     ],
        //     [
        //         'employee_id' => 1, 'salary_type_id' => SalaryType::EARNING,
        //         'salary_component_id' => 3, 'amount' => 5000
        //     ],
        //     [
        //         'employee_id' => 1, 'salary_type_id' => SalaryType::DEDUCTION,
        //         'salary_component_id' => 4, 'amount' => 1000
        //     ],
        //     [
        //         'employee_id' => 1, 'salary_type_id' => SalaryType::DEDUCTION,
        //         'salary_component_id' => 5, 'amount' => 500
        //     ],

        //     [
        //         'employee_id' => 2, 'salary_type_id' => SalaryType::EARNING,
        //         'salary_component_id' => 1, 'amount' => 120000
        //     ],
        //     [
        //         'employee_id' => 2, 'salary_type_id' => SalaryType::EARNING,
        //         'salary_component_id' => 2, 'amount' => 6000
        //     ],
        //     [
        //         'employee_id' => 2, 'salary_type_id' => SalaryType::EARNING,
        //         'salary_component_id' => 3, 'amount' => 2000
        //     ],
        //     [
        //         'employee_id' => 2, 'salary_type_id' => SalaryType::DEDUCTION,
        //         'salary_component_id' => 4, 'amount' => 400
        //     ],
        //     [
        //         'employee_id' => 2, 'salary_type_id' => SalaryType::DEDUCTION,
        //         'salary_component_id' => 5, 'amount' => 200
        //     ],




        //     [
        //         'employee_id' => 3, 'salary_type_id' => SalaryType::EARNING,
        //         'salary_component_id' => 1, 'amount' => 60000
        //     ],
        //     [
        //         'employee_id' => 3, 'salary_type_id' => SalaryType::EARNING,
        //         'salary_component_id' => 2, 'amount' => 3000
        //     ],
        //     [
        //         'employee_id' => 3, 'salary_type_id' => SalaryType::EARNING,
        //         'salary_component_id' => 3, 'amount' => 1000
        //     ],
        //     [
        //         'employee_id' => 3, 'salary_type_id' => SalaryType::DEDUCTION,
        //         'salary_component_id' => 4, 'amount' => 200
        //     ],
        //     [
        //         'employee_id' => 3, 'salary_type_id' => SalaryType::DEDUCTION,
        //         'salary_component_id' => 5, 'amount' => 100
        //     ],





        // ];
    }
}
