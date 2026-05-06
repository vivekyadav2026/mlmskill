@extends('layouts.user')

@section('content')

<style>
  .app-main { padding: 20px; }
  
  /* Tree CSS */
  .tree ul {
    padding-top: 20px; position: relative;
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
    display: flex;
    justify-content: center;
  }
  .tree li {
    float: left; text-align: center;
    list-style-type: none;
    position: relative;
    padding: 20px 5px 0 5px;
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
  }
  .tree li::before, .tree li::after{
    content: '';
    position: absolute; top: 0; right: 50%;
    border-top: 2px solid #475569;
    width: 50%; height: 20px;
  }
  .tree li::after{
    right: auto; left: 50%;
    border-left: 2px solid #475569;
  }
  .tree li:only-child::after, .tree li:only-child::before {
    display: none;
  }
  .tree li:only-child{ padding-top: 0;}
  .tree li:first-child::before, .tree li:last-child::after{
    border: 0 none;
  }
  .tree li:last-child::before{
    border-right: 2px solid #475569;
    border-radius: 0 5px 0 0;
  }
  .tree li:first-child::after{
    border-radius: 5px 0 0 0;
  }
  .tree ul ul::before{
    content: '';
    position: absolute; top: 0; left: 50%;
    border-left: 2px solid #475569;
    width: 0; height: 20px;
  }
  .tree li a {
    border: 1px solid #334155;
    padding: 10px;
    text-decoration: none;
    color: #e2e8f0;
    font-family: arial, verdana, tahoma;
    font-size: 11px;
    display: inline-block;
    border-radius: 5px;
    background-color: #1a222d;
    transition: all 0.5s;
  }
  .tree li a:hover, .tree li a:hover+ul li a {
    background: #1e293b; color: #fff; border: 1px solid #6366f1;
  }
  .tree li a:hover+ul li::after, 
  .tree li a:hover+ul li::before, 
  .tree li a:hover+ul::before, 
  .tree li a:hover+ul ul::before{
    border-color:  #6366f1;
  }
</style>
<div class="tailwind-scope mt-4">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Team Tree (Level View)</h2>
        <p class="text-gray-400">Visual representation of your MLM downline structure.</p>
    </div>

    <div class="bg-[#1a222d] rounded-lg shadow-lg p-6 border border-[#334155] overflow-x-auto flex justify-center">
        <div class="tree">
            <ul>
                @include('user.network.partials.tree_node', ['node' => $user])
            </ul>
        </div>
    </div>
</div>
@endsection
