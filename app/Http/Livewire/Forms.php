<?php

namespace App\Http\Livewire;
use App\Models\employee;
use Livewire\Component;
use Livewire\withPagination;

class Forms extends Component
{
   use withPagination;
   public $search;
   
    public $name;
    public $email;
    public $hiddenEmpId;
    // public $allEmployees = [];

    protected $rules=[
        'name'=> 'required|min:3|max:50',
        'email' => 'required|email'
    ];

    public function submit(){
   
        
        $this->validate();
        
        $updateEmpId = $this->hiddenEmpId;
        if($updateEmpId > 0){
            // update 
            $updateArray = array(
                'name'=> $this->name,
                'email'=>$this->email
            );
            $employee = employee::findorFail($updateEmpId);
            $employee->name = $updateArray['name'];
            $employee->email = $updateArray['email'];
            $employee->save();
        }else{
            employee::create([
                'name'=>$this->name,
                'email' =>$this->email
            ]);

        }

      
        session()->flash('success','form is submitted');

    }
    public function edit($id){
        $employee = employee::find ($id);
        $this->name = $employee->name;
        $this->email = $employee->email;

        $this->hiddenEmpId = $employee->id;
    }
    public function create(){
        $this->name = "";
        $this->email = "";
        $this->hiddenEmpId = "";

    }
    public function delete($id){
       $employee = employee::findorFail($id);
       $employee->delete();
       session()->flash('delete','records deleted');

    }
   
    
    public function render()
    {
      
        return view('livewire.forms',[
            'allEmployees' => employee::when($this->search,function($query){
            return  $query->where('name','LIKE','%'.$this->search.'%');

            })->orderBy('name','ASC')->get()
        ]);

    }
}
