<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Profile extends Component
{
    use WithFileUploads;

    public User $user;
    public $contact = "";
    public $constituent = "";
    public $selectedCollege = "";
    public $degprog = "";
    public $current_password = "";
    public $wrong_password = "";
    public $open_modal = "";
    public $new_password = "";

    #[Validate('image|max:1024')]
    public $image_upload;
    public $types = [
        'Student' => 'student',
        'Faculty Member' => 'faculty',
        'Administrative Staff' => 'staff',
        'Alumnus' => 'alumnus'
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

    public function __construct()
    {
        $this->user = User::where('id', Auth::user()->id)->firstOrFail();
    }

    public function updatePasabuyPoints()
    {
        // Get today's date as a string
        $today = now()->Timezone('Singapore')->format('Y-m-d');
        $user = User::where('id', Auth::user()->id)->first();

        if ($user->pasabuy_points === 100) {
            return;
        }
        
        // Check if points have already been added today using session
        if (!session()->has('pasabuy_points_added_on') || session('pasabuy_points_added_on') !== $today) {
            // Get current user
            
            // Add points
            $user->pasabuy_points += 1;
            $user->save();
            
            // Mark that points were added today
            session(['pasabuy_points_added_on' => $today]);
            
            // For feedback to the user
            session()->flash('message', 'You received 1 Pasabuy point!');
            return true;
        }
        
        return false;
    }

    public function changeRole()
    {
        $user = $this->user;
        $user->role = $user->role === "customer" ? 'provider' : 'customer';
        $user->save();
        session()->flash('change_role_success', "You are now logged in as " . ucwords($user->role) . ".");
        return $this->redirect(route('profile', ['name' => $user->name]), true);
    }

    public function uploadImage()
    {
        try {
            if ($this->image_upload) {

                $imageUrl = Cloudinary::uploadFile($this->image_upload->getRealPath())->getSecurePath();
                $this->user->profile_pic_url = $imageUrl;
                $this->user->save();
                session()->flash('dp_change', 'Profile picture changed successfully!');
                return redirect(route('profile', ['name' => $this->user->name]));

            }
        } catch (\Throwable $th) {
            //throw $th;
            session()->flash('error', 'An error has occurred. Try again.');
            return redirect(route('profile', ['name' => $this->user->name]));
        }
    }

    public function saveInfoChanges()
    {
        // dd(['contact' => $this->contact, 'constituent' => $this->constituent, 'college' => $this->selectedCollege, 'degprog' => $this->degprog]);
        $user = $this->user;
        if ($this->contact !== '') {
            $userFind = User::where('contact_number', $this->contact)->exists();
            if ($userFind) {
                session()->flash('contact_error', 'Contact number already exists.');
                return $this->redirect(route('profile', ['name' => $user->name]), true);
            }
            $user->contact_number = $this->contact;
        }
        if ($this->constituent !== '') $user->constituent = $this->constituent;
        if ($this->constituent === 'staff') $user->degree_program = "";
        if ($this->selectedCollege !== '') $user->college = $this->selectedCollege;
        if ($this->degprog !== '') $user->degree_program = $this->degprog;

        $user->save();
        session()->flash('change_info_success', "Changes successfully saved.");
        return $this->redirect(route('profile', ['name' => $user->name]), true);
    }
    public function checkPassword()
    {   
        $user = $this->user;
        if (Hash::check($this->current_password, $user->password)) {
            $this->wrong_password = false;
            $this->open_modal = true;
        } else {
            $this->wrong_password = true;
            $this->open_modal = false;
        }
    }

    public function savePassChanges()
    {
        $user = $this->user;

        $user->password = Hash::make($this->new_password);
        $user->save();
        session()->flash('change_pass_success', "Password successfully changed.");
        return $this->redirect(route('profile', ['name' => $user->name]), true);
    }

    public function logOut()
    {
        Auth::logout();
        return $this->redirect(route('login'), true);
    }

    public function deleteAccount()
    {
        $user = $this->user;
        $user->delete();
        Auth::logout();
        session()->flash('delete_account_success', "Account successfully deleted.");
        return $this->redirect(route('login'), true);
    }

    public function render()
    {
        $currentTime = now();
        if ($currentTime->Timezone('Singapore')->format('H:i') === '16:00') {
            $this->updatePasabuyPoints();
        }

        $user = Auth::user();
        return view('livewire.profile', ['user' => $user]);
    }
}
