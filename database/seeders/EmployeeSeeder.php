<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            // Branch 1
            ['branch_id' => 1, 'name' => 'Maizatul Aqma Mokhtar', 'first' => 'Maizatul', 'middle' => 'Aqma', 'last' => 'Mokhtar', 'email' => 'maizatulmokhtar85@another.com', 'phone' => '126103085', 'position' => 'Junior Developer'],
            ['branch_id' => 1, 'name' => 'Ahmad Faris Abdullah', 'first' => 'Ahmad', 'middle' => 'Faris', 'last' => 'Abdullah', 'email' => 'ahmadfaris@another.com', 'phone' => '112233445', 'position' => 'Senior Developer'],
            ['branch_id' => 1, 'name' => 'Nurul Ain Zulkifli', 'first' => 'Nurul', 'middle' => 'Ain', 'last' => 'Zulkifli', 'email' => 'nurulain@another.com', 'phone' => '112233446', 'position' => 'UI/UX Designer'],
            ['branch_id' => 1, 'name' => 'Mohd Haziq Ramli', 'first' => 'Mohd', 'middle' => 'Haziq', 'last' => 'Ramli', 'email' => 'haziqramli@another.com', 'phone' => '112233447', 'position' => 'Project Manager'],
            ['branch_id' => 1, 'name' => 'Siti Nabilah Hassan', 'first' => 'Siti', 'middle' => 'Nabilah', 'last' => 'Hassan', 'email' => 'sitinabilah@another.com', 'phone' => '112233448', 'position' => 'QA Engineer'],
            ['branch_id' => 1, 'name' => 'Izzatul Husna Kamal', 'first' => 'Izzatul', 'middle' => 'Husna', 'last' => 'Kamal', 'email' => 'izzatulhusna@another.com', 'phone' => '112233449', 'position' => 'Business Analyst'],
            ['branch_id' => 1, 'name' => 'Rahimi Che Mat', 'first' => 'Rahimi', 'middle' => 'Che', 'last' => 'Mat', 'email' => 'rahimichemat@another.com', 'phone' => '112233450', 'position' => 'DevOps Engineer'],
            ['branch_id' => 1, 'name' => 'Farah Diyana Yusoff', 'first' => 'Farah', 'middle' => 'Diyana', 'last' => 'Yusoff', 'email' => 'farahdiyana@another.com', 'phone' => '112233451', 'position' => 'Frontend Developer'],
            ['branch_id' => 1, 'name' => 'Amirul Hakim Nordin', 'first' => 'Amirul', 'middle' => 'Hakim', 'last' => 'Nordin', 'email' => 'amirulhakim@another.com', 'phone' => '112233452', 'position' => 'Backend Developer'],
            ['branch_id' => 1, 'name' => 'Zulaikha Mohd Noor', 'first' => 'Zulaikha', 'middle' => 'Mohd', 'last' => 'Noor', 'email' => 'zulaikha@another.com', 'phone' => '112233453', 'position' => 'Data Analyst'],
            ['branch_id' => 1, 'name' => 'Hafizuddin Saad', 'first' => 'Hafizuddin', 'middle' => null, 'last' => 'Saad', 'email' => 'hafizuddin@another.com', 'phone' => '112233454', 'position' => 'System Administrator'],
            ['branch_id' => 1, 'name' => 'Norsyafiqah Ismail', 'first' => 'Norsyafiqah', 'middle' => null, 'last' => 'Ismail', 'email' => 'norsyafiqah@another.com', 'phone' => '112233455', 'position' => 'HR Executive'],
            ['branch_id' => 1, 'name' => 'Shahril Azwan Bakar', 'first' => 'Shahril', 'middle' => 'Azwan', 'last' => 'Bakar', 'email' => 'shahrilazwan@another.com', 'phone' => '112233456', 'position' => 'Network Engineer'],
            ['branch_id' => 1, 'name' => 'Khairunnisa Abdul Razak', 'first' => 'Khairunnisa', 'middle' => 'Abdul', 'last' => 'Razak', 'email' => 'khairunnisa@another.com', 'phone' => '112233457', 'position' => 'Marketing Executive'],
            ['branch_id' => 1, 'name' => 'Luqmanul Hakim Daud', 'first' => 'Luqmanul', 'middle' => 'Hakim', 'last' => 'Daud', 'email' => 'luqmanul@another.com', 'phone' => '112233458', 'position' => 'Mobile Developer'],
            ['branch_id' => 1, 'name' => 'Suraya Mohd Yusuf', 'first' => 'Suraya', 'middle' => 'Mohd', 'last' => 'Yusuf', 'email' => 'suraya@another.com', 'phone' => '112233459', 'position' => 'Accountant'],
            ['branch_id' => 1, 'name' => 'Imran Hakimi Rosli', 'first' => 'Imran', 'middle' => 'Hakimi', 'last' => 'Rosli', 'email' => 'imranhakimi@another.com', 'phone' => '112233460', 'position' => 'Security Analyst'],
            ['branch_id' => 1, 'name' => 'Fatin Nabila Johari', 'first' => 'Fatin', 'middle' => 'Nabila', 'last' => 'Johari', 'email' => 'fatinnabila@another.com', 'phone' => '112233461', 'position' => 'Content Writer'],
            ['branch_id' => 1, 'name' => 'Azri Syafwan Ghazali', 'first' => 'Azri', 'middle' => 'Syafwan', 'last' => 'Ghazali', 'email' => 'azrisyafwan@another.com', 'phone' => '112233462', 'position' => 'Cloud Engineer'],
            ['branch_id' => 1, 'name' => 'Hanis Syazwani Hamid', 'first' => 'Hanis', 'middle' => 'Syazwani', 'last' => 'Hamid', 'email' => 'hanissyazwani@another.com', 'phone' => '112233463', 'position' => 'Support Engineer'],
            ['branch_id' => 1, 'name' => 'Ridhwan Azizi Osman', 'first' => 'Ridhwan', 'middle' => 'Azizi', 'last' => 'Osman', 'email' => 'ridhwanazizi@another.com', 'phone' => '112233464', 'position' => 'Database Administrator'],
            ['branch_id' => 1, 'name' => 'Syazana Illyana Mansor', 'first' => 'Syazana', 'middle' => 'Illyana', 'last' => 'Mansor', 'email' => 'syazanaillyana@another.com', 'phone' => '112233465', 'position' => 'Product Manager'],
            ['branch_id' => 1, 'name' => 'Haikal Asyraf Jaafar', 'first' => 'Haikal', 'middle' => 'Asyraf', 'last' => 'Jaafar', 'email' => 'haikalasyraf@another.com', 'phone' => '112233466', 'position' => 'Full Stack Developer'],
            ['branch_id' => 1, 'name' => 'Anis Farhanah Zainudin', 'first' => 'Anis', 'middle' => 'Farhanah', 'last' => 'Zainudin', 'email' => 'anisfarhanah@another.com', 'phone' => '112233467', 'position' => 'Scrum Master'],
            ['branch_id' => 1, 'name' => 'Muzaffar Izzat Sulaiman', 'first' => 'Muzaffar', 'middle' => 'Izzat', 'last' => 'Sulaiman', 'email' => 'muzaffarizzat@another.com', 'phone' => '112233468', 'position' => 'IT Consultant'],

            // Branch 2 - 15 employees
            ['branch_id' => 2, 'name' => 'Nadia Syahirah Kadir', 'first' => 'Nadia', 'middle' => 'Syahirah', 'last' => 'Kadir', 'email' => 'nadiasyahirah@another.com', 'phone' => '113344001', 'position' => 'Branch Manager'],
            ['branch_id' => 2, 'name' => 'Fairuz Fadzli Hashim', 'first' => 'Fairuz', 'middle' => 'Fadzli', 'last' => 'Hashim', 'email' => 'fairuzfadzli@another.com', 'phone' => '113344002', 'position' => 'Senior Developer'],
            ['branch_id' => 2, 'name' => 'Liyana Husna Tajudin', 'first' => 'Liyana', 'middle' => 'Husna', 'last' => 'Tajudin', 'email' => 'liyanahusna@another.com', 'phone' => '113344003', 'position' => 'UI/UX Designer'],
            ['branch_id' => 2, 'name' => 'Aizat Shafiq Musa', 'first' => 'Aizat', 'middle' => 'Shafiq', 'last' => 'Musa', 'email' => 'aizatshafiq@another.com', 'phone' => '113344004', 'position' => 'Frontend Developer'],
            ['branch_id' => 2, 'name' => 'Roslinda Wahab', 'first' => 'Roslinda', 'middle' => null, 'last' => 'Wahab', 'email' => 'roslinda@another.com', 'phone' => '113344005', 'position' => 'HR Executive'],
            ['branch_id' => 2, 'name' => 'Firdaus Hakimi Zaki', 'first' => 'Firdaus', 'middle' => 'Hakimi', 'last' => 'Zaki', 'email' => 'firdaushakimi@another.com', 'phone' => '113344006', 'position' => 'Backend Developer'],
            ['branch_id' => 2, 'name' => 'Sharmila Devi Rajan', 'first' => 'Sharmila', 'middle' => 'Devi', 'last' => 'Rajan', 'email' => 'sharmila@another.com', 'phone' => '113344007', 'position' => 'QA Engineer'],
            ['branch_id' => 2, 'name' => 'Kamarul Ariffin Bahari', 'first' => 'Kamarul', 'middle' => 'Ariffin', 'last' => 'Bahari', 'email' => 'kamarulariffin@another.com', 'phone' => '113344008', 'position' => 'DevOps Engineer'],
            ['branch_id' => 2, 'name' => 'Putri Balqis Razman', 'first' => 'Putri', 'middle' => 'Balqis', 'last' => 'Razman', 'email' => 'putribalqis@another.com', 'phone' => '113344009', 'position' => 'Data Analyst'],
            ['branch_id' => 2, 'name' => 'Suffian Azhar Zainol', 'first' => 'Suffian', 'middle' => 'Azhar', 'last' => 'Zainol', 'email' => 'suffianazhar@another.com', 'phone' => '113344010', 'position' => 'System Administrator'],
            ['branch_id' => 2, 'name' => 'Maslinda Mohd Ariff', 'first' => 'Maslinda', 'middle' => 'Mohd', 'last' => 'Ariff', 'email' => 'maslinda@another.com', 'phone' => '113344011', 'position' => 'Accountant'],
            ['branch_id' => 2, 'name' => 'Zarif Amsyar Zulkarnain', 'first' => 'Zarif', 'middle' => 'Amsyar', 'last' => 'Zulkarnain', 'email' => 'zarifamsyar@another.com', 'phone' => '113344012', 'position' => 'Mobile Developer'],
            ['branch_id' => 2, 'name' => 'Aisyah Humaira Othman', 'first' => 'Aisyah', 'middle' => 'Humaira', 'last' => 'Othman', 'email' => 'aisyahhumaira@another.com', 'phone' => '113344013', 'position' => 'Marketing Executive'],
            ['branch_id' => 2, 'name' => 'Hafiy Danial Salim', 'first' => 'Hafiy', 'middle' => 'Danial', 'last' => 'Salim', 'email' => 'hafiydanial@another.com', 'phone' => '113344014', 'position' => 'Network Engineer'],
            ['branch_id' => 2, 'name' => 'Norfazilah Azmi', 'first' => 'Norfazilah', 'middle' => null, 'last' => 'Azmi', 'email' => 'norfazilah@another.com', 'phone' => '113344015', 'position' => 'Support Engineer'],

            // Branch 3 - 7 employees
            ['branch_id' => 3, 'name' => 'Hazwan Syafiq Mohd Ali', 'first' => 'Hazwan', 'middle' => 'Syafiq', 'last' => 'Mohd Ali', 'email' => 'hazwansyafiq@another.com', 'phone' => '114455001', 'position' => 'Branch Manager'],
            ['branch_id' => 3, 'name' => 'Nadhirah Izzati Sudin', 'first' => 'Nadhirah', 'middle' => 'Izzati', 'last' => 'Sudin', 'email' => 'nadhirahizzati@another.com', 'phone' => '114455002', 'position' => 'Senior Developer'],
            ['branch_id' => 3, 'name' => 'Syafiq Ammar Lokman', 'first' => 'Syafiq', 'middle' => 'Ammar', 'last' => 'Lokman', 'email' => 'syafiqammar@another.com', 'phone' => '114455003', 'position' => 'Frontend Developer'],
            ['branch_id' => 3, 'name' => 'Rohana Che Awang', 'first' => 'Rohana', 'middle' => 'Che', 'last' => 'Awang', 'email' => 'rohanacheawang@another.com', 'phone' => '114455004', 'position' => 'HR Executive'],
            ['branch_id' => 3, 'name' => 'Danial Afiq Mustafa', 'first' => 'Danial', 'middle' => 'Afiq', 'last' => 'Mustafa', 'email' => 'danialafiq@another.com', 'phone' => '114455005', 'position' => 'Backend Developer'],
            ['branch_id' => 3, 'name' => 'Nor Athirah Ramlan', 'first' => 'Nor', 'middle' => 'Athirah', 'last' => 'Ramlan', 'email' => 'norathirah@another.com', 'phone' => '114455006', 'position' => 'QA Engineer'],
            ['branch_id' => 3, 'name' => 'Amzar Fitri Baharom', 'first' => 'Amzar', 'middle' => 'Fitri', 'last' => 'Baharom', 'email' => 'amzarfitri@another.com', 'phone' => '114455007', 'position' => 'Data Analyst'],
        ];

        foreach ($employees as $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'role_id' => '4',
            ]);

            // Get company_id from the branch
            $branch = Branch::find($data['branch_id']);

            Employee::create([
                'user_id'     => $user->id,
                'branch_id'   => $data['branch_id'],
                'company_id'  => $branch->company_id,
                'full_name'   => $data['name'],
                'first_name'  => $data['first'],
                'middle_name' => $data['middle'],
                'last_name'   => $data['last'],
                'email'       => $data['email'],
                'country_code' => '60',
                'phone'       => $data['phone'],
                'position'    => $data['position'],
            ]);
        }
    }
}
