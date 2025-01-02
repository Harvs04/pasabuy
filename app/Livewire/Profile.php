<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Profile extends Component
{
    public $count = 0;
    public $contact = "";
    public $constituent = "";
    public $selectedCollege = "";
    public $degprog = "";
    public $current_password = "";
    public $wrong_password = "";
    public $new_password = "";
    public $types = [
        'Student' => 'student',
        'Faculty Member' => 'faculty',
        'Administrative Staff' => 'staff',
        'Alumni' => 'alumni'
    ];
    public $colleges = [
        "College of Agriculture and Food Science (CAFS)",
        "College of Arts and Sciences (CAS)",
        "College of Development Communication (CDC)",
        "College of Economics and Management (CEM)",
        "College of Engineering and Agro-industrial Technology (CEAT)",
        "College of Forestry and Natural Resources (CFNR)",
        "College of Human Ecology (CHE)",
        "College of Veterinary Medicine (CVM)",
        "College of Public Affairs and Development (CPAD)",
        "School of Environmental Science and Management (SESAM)"
    ];
    public $degprogs = [
        "College of Agriculture and Food Science (CAFS)" => [
            "BS Agriculture",
            "BS Agricultural Biotechnology",
            "BS Agricultural Chemistry",
            "BS Food Science and Technology",
            "Master of Agriculture major in Agronomy",
            "Master of Agriculture major in Horticulture",
            "Master of Science in Agricultural Chemistry",
            "Master in Animal Nutrition",
            "Master in Food Engineering",
            "Master of Science in Agricultural Education",
            "Master of Science in Animal Science",
            "Master of Science in Agronomy",
            "Master of Science in Food Science",
            "Master of Science in Horticulture",
            "Master of Science in Botany",
            "Master of Science in Plant Breeding",
            "Master of Science in Plant Pathology",
            "Master of Science in Soil Science",
            "Master of Science in Plant Genetics Resources Conservation and Management",
            "Master of Science in Rural Sociology",
            "PhD by Research in Food Science",
        ],
        "College of Arts and Sciences (CAS)" => [
            "Associate in Arts in Sports Studies",
            "BA Communication Arts",
            "BA Philosophy",
            "BA Sociology",
            "BS Applied Mathematics",
            "BS Applied Physics",
            "BS Biology",
            "BS Chemistry",
            "BS Computer Science",
            "BS Mathematics",
            "BS Mathematics and Science Teaching",
            "BS Statistics",
            "Doctors of Philosophy by Research (Applied Physics)",
            "Master in Communication Arts",
            "Master in Science in Physics",
            "Master of Arts in Communication Arts",
            "Master of Arts in Sociology",
            "Master of Information Technology",
            "Master of Science in Applied Physics",
            "Master of Science in Biochemistry",
            "Master of Science in Chemistry",
            "Master of Science in Computer Science",
            "Master of Science in Genetics",
            "Master of Science in Mathematics",
            "Master of Science in Microbiology",
            "Master of Science in Molecular Biology and Biotechnology",
            "Master of Science in Statistics",
            "Master of Science in Wildlife Studies",
            "Master of Science in Zoology",
            "PhD by Research in Agricultural Chemistry",
            "PhD by Research in Biochemistry",
            "PhD by Research in Wildlife Science",
            "PhD by Research in Zoology"
        ],
        "College of Development Communication (CDC)" => [
            "Associate of Science in Development Communication",
            "BS Development Communication (COE)",
            "Master of Science in Development Communication"
        ],
        "College of Economics and Management (CEM)" => [
            "Associate in Arts in Entrepreneurship",
            "Bachelor of Science in Accountancy",
            "BS Agribusiness Management and Entrepreneurship",
            "BS Agricultural and Applied Economics",
            "BS Economics",
            "Master of Management major in Agribusiness Management and Entrepreneurship",
            "Master of Management major in Business Management",
            "Master of Management major in Cooperative Management",
            "Master of Science in Agricultural Economics",
            "Master of Science in Economics"
        ],
        "College of Engineering and Agro-industrial Technology (CEAT)" => [
            "Bachelor of Science in Materials Engineering",
            "Bachelor of Science in Mechanical Engineering",
            "BS Agricultural and Biosystems Engineering",
            "BS Chemical Engineering",
            "BS Civil Engineering",
            "BS Electrical Engineering",
            "BS Industrial Engineering",
            "BS Materials Engineering",
            "BS Mechanical Engineering",
            "Master in Food Engineering",
            "Master of Science in Agricultural Engineering",
            "Master of Science in Agrometeorology",
            "Master of Science in Chemical Engineering",
            "Master of Science in Industrial Engineering",
            "PhD by Research in Chemical Engineering"
        ],
        "College of Forestry and Natural Resources (CFNR)" => [
            "Associate of Science in Forestry",
            "BS Forestry",
            "Master of Forestry",
            "Master of Science in Forestry",
            "Master of Science in Natural Resources Conservation"
        ],
        "College of Human Ecology (CHE)" => [
            "BS Human Ecology",
            "BS Nutrition",
            "Graduate Diploma in Environmental Planning"
        ],
        "College of Veterinary Medicine (CVM)" => [
            "Doctor of Veterinary Medicine",
            "Master in Veterinary Epidemiology",
            "Master of Science in Veterinary Medicine",
            "PhD by Research in Veterinary Medicine",
            "PhD in Veterinary Medicine (Residential Mode)"
        ],
        "College of Public Affairs and Development (CPAD)" => [
            "Master in Public Affairs",
            "Master of Development Management and Governance",
            "Master of Science in Community Development",
            "Master of Science in Development Management and Governance",
            "Master of Science in Extension Education"
        ],
        "School of Environmental Science and Management (SESAM)" => [
            "Master of Science in Environmental Science",
            "PhD in Environmental Diplomacy and Negotiations",
            "Professional Masters in Tropical Marine Ecosystems Management"
        ]
    ];
    public function saveInfoChanges()
    {
        // dd(['contact' => $this->contact, 'constituent' => $this->constituent, 'college' => $this->selectedCollege, 'degprog' => $this->degprog]);
        $user = User::where('id', Auth::user()->id)->first();
        if ($this->contact !== '') $user->contact_number = $this->contact;
        if ($this->constituent !== '') $user->constituent = $this->constituent;
        if ($this->constituent === 'staff') $user->degree_program = "";
        if ($this->selectedCollege !== '') $user->college = $this->selectedCollege;
        if ($this->degprog !== '') $user->degree_program = $this->degprog;

        $user->save();
        session()->flash('change_info_success', "Changes successfully saved.");
        return redirect()->route('profile', ['name' => $user->name]);
    }
    public function checkPassword()
    {   
        $this->count++;
        if ($this->count === 10) dd("10 na po");
        // dd($this->current_password);
        $user = User::where('id', Auth::user()->id)->first();
        if (Hash::check($this->current_password, $user->password)) {
            $this->wrong_password = "";
        } else {
            $this->wrong_password = "Current password is incorrect.";
        }
        // dd($this->wrong_password);
    }
    public function logOut()
    {
        Auth::logout();
        return redirect('login');
    }

    public function deleteAccount()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->delete();
        Auth::logout();
        session()->flash('delete_account_success', "Account successfully deleted.");
        return redirect('login');
    }

    public function changeRole()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->role = $user->role === "customer" ? 'provider' : 'customer';
        $user->save();

        session()->flash('change_role_success', "You are now logged in as " . ucwords($user->role) . ".");
        return redirect()->route('profile', ['name' => $user->name]);
    }
    public function render()
    {
        $user = Auth::user();
        return view('livewire.profile', ['user' => $user]);
    }
}
