
<div id="form">
<form wire:submit.prevent="submit">
    @if(session()->has('success'))
    <span style="color: blue">{{session('success')}}</span></br>
    @elseif(session()->has('delete'))
    <span style="color:red">{{session('delete')}}</span></br>
    @endif

    <input type="hidden" wire:model="hiddenEmpId" value="{{$hiddenEmpId}}"></br>

    Name:<br><input type="text" wire:model="name"></br>
    @error('name')
    <span style="color:red">{{$message}}</span>
    @enderror
    Email:<br><input type="email" wire:model="email"></br>
    @error('email')
    <span style="color:red">{{$message}}</span>
    @enderror
    </br>
    <button type="submit">save</button>
</form>

<h5>view Employees</h5>
<a href="javascript:void(0)" wire:click="create"> Add Employee</a></br>

<label for="for">Search</label>
    <input type="text" wire:model = "search">
 
</br>



<table class="table">
    <tr>
        <td>Name</td>
        <td>Email</td>
        <td>selection</td>
        
    </tr>
    @foreach($allEmployees as $employee)
    <tr>
        <td>{{$employee->name}}</td>
        <td>{{$employee->email}}</td>
        <td>
            <a href="javascript:void(0)" wire:click="edit({{$employee->id}})"> Edit</a>
            <a href="javascript:void(0)" wire:click="delete({{$employee->id}})"> delete</a>
        </td>
    </tr>
    @endforeach
</table>

</div>


<style>
   
    table{
        border-collapse:collapse;
        width:100%;
    }
    td,th{
        border:1px solid
    }
    
</style>
