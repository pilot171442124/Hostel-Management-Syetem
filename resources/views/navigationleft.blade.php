<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="dashboard-menu">
                <a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
            </li>

            @if(Auth::check())
          
          @if(Auth::user()->userrole =='Admin')

            
            
            
          <li class="studentinfo-menu">
                <a href="#"><i class="fa fa-credit-card"></i> <span class="nav-label">Import Student Info</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="studentid-menu"><a href="{{ url('importstudentid') }}"> Import Student ID</a></li>
                    
                    <li class="importsingleid-menu"><a href="{{ url('importsingleid') }}"> Import Single ID</a></li>

                   
                </ul>
            </li>
            
            
            
            
            
            
            
            
            <li class="Studentuser-menu ">
                <a href="#"><i class="fa fa-credit-card"></i> <span class="nav-label">User Management</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                <li class="createuser-menu "><a href="{{ url('userentry') }}">Create User</a></li>
                    <li class="userlist-menu"><a href="{{ url('userlistview') }}">User List View</a></li>
                </ul>
            </li>


            <li class="HallManagement-menu ">
                <a href="#"><i class="fa fa-credit-card"></i> <span class="nav-label">Hall Management</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                <li><a href="{{ url('/viewhall') }}">View Hall</a></li> 
                
                <li class="hallnameentry-menu"><a href="{{ url('hallnameentry') }}">Hall Name Entry</a></li>
                    <li class="viewhallname-menu"><a href="{{ url('viewhallname') }}">View Hall Name </a></li>
                </ul>
            </li>




            <li class="RoomManagement-menu ">
                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Room Management</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="createroom-menu "><a href="{{ url('createroom') }}">Create Room</a></li>
                    <li class="viewroom-menu"><a href="{{ url('viewroom') }}">View Room</a></li>
                    <li class="leaveroom-menu"><a href="{{ url('leaveroom') }}">Leave Room</a></li>




                </ul>
            </li>
            


            <li class="StudentManagementbyadmin-menu">
                <a href="#"><i class="fa fa-graduation-cap"></i> <span class="nav-label">Student Management</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="Admission-menu"><a href="{{ url('admission') }}">Admission</a></li>
                  
                    <li class="pendinglist-menu"><a href="{{ url('pendingrequest') }}">Peding Request list</a></li>


                    <li class="viewstudentlistrequest-menu"><a href="{{ url('viewstudentlist&request') }}">View Student List & Request</a></li>
                    <li class="admissionformpaymentfail-menu"><a href="{{ url('admissionformpaymentfail') }}">Addmision Payment Fail</a></li>

                </ul>
            </li>
        




        
            <li class="StudentPayment-menu">
                <a href="#"><i class="fa fa-credit-card"></i> <span class="nav-label">Student Payment</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="bkashpayment-menu"><a href="{{ url('studentbill') }}">Student Bill</a></li>
                    <li class="generatebill-menu"><a href="{{ url('generatebill') }}">Create Bill Per Month</a></li>
                    
                   <!-- 
                    <li class="pay-menu"><a href="{{ url('pay') }}">pay</a></li>
                    -->
                  
                    



<li class="costvw-menu">

<a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Sub menu</span> <span class="fa arrow"></span></a>

<ul class="nav nav-second-level">
<li class="submenu"> <a href="">Cost Management</a></li>
<li class="submenu"> <a href="">Cost Management</a></li>
<li class="submenu"> <a href="">Cost Management</a></li>
<li class="submenu"> <a href="">Cost Management cost</a></li>

<li class="costvw-menu">

<a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Sub menu</span> <span class="fa arrow"></span></a>

<ul class="nav nav-second-level">
<li class="submenu"> <a href="">Cost Management</a></li>
<li class="submenu"> <a href="">Cost Management</a></li>
<li class="submenu"> <a href="">Cost Management</a></li>
<li class="submenu"> <a href="">Cost Management cost</a></li>

</ul>

</li>











</ul>



</li>










                    
                </ul>
            </li>
           
            


            <li class="EmployeeManagement-menu">
                <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Employee Manage</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="addnewemployee-menu"><a href="{{ url('addnewemployee') }}">Add New</a></li>
                    <li class="Employeelist-menu"><a href="{{ url('Employeelist') }}">List View</a></li>
                    <li class="addsalary-menu"><a href="{{ url('salary') }}">Salary Add</a></li>
                    <li class="salaryview-menu"><a href="{{ url('salaryview') }}">Salary View</a></li>

                </ul>
            </li>
        
     





           
            <li class="Attendance-menu ">
                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Attendance</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
              
                    <li class="addattendance-menu "><a href="{{ url('addattendance') }}">Add Attendance </a></li>
                    <li class="addattendancereport-menu "><a href="{{ url('addattendancereport') }}">Attendance Reports</a></li>
                    

                    <!--<li class="examinationmarks_report-menu"><a href="examinationmarks_report.php">Students Marks</a></li>-->
                </ul>
            </li>
  
            <li class="MealManagement-menu">
                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Meal Management</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                <li class="foodlistentry-menu"><a href="{{ url('foodlistentry') }}">Food List Entry</a></li>

                   <li class="maketodayfoodlist-menu"><a href="{{ url('maketodayfoodlist') }}">Make Today Food List</a></li>
                   <li class="takebill-menu"><a href="{{ url('takebill') }}">Take Bill</a></li>
                   
                   
                </ul>
            </li>
            
            <li class="CostManagement-menu">
                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Cost Management</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="costentry-menu"><a href="{{ url('costentry') }}">Cost Entry</a></li>
                    <li class="costview-menu"><a href="{{ url('costview') }}">Cost View</a></li>
                   

               
                    
                </ul>
            </li>











      <!--
            <li class="BillManagement-menu">
                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Bill Management</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="onlineclass-menu"><a href="{{ url('onlineclassentry') }}">Online Class</a></li>
                    <li class="notice-menu"><a href="{{ url('noticeentry') }}">Notice & Assignment</a></li>
                    <li class="onlineaddmission-menu"><a href="{{ url('admissionform') }}">Admission Form</a></li>
                </ul>
            </li>

            <li class="NoticeBoard-menu">
                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">NoticeBoard</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="onlineclass-menu"><a href="#">Online Class</a></li>
                    <li class="notice-menu"><a href="#">Notice & Assignment</a></li>
                    <li class="onlineaddmission-menu"><a href="#">Admission Form</a></li>
                </ul>
            </li>      
            -->
          
            @endif

            @if(Auth::user()->userrole =='Student')

            <li class="StudentManagementbyadmin-menu">
                <a href="#"><i class="fa fa-graduation-cap"></i> <span class="nav-label">Student </span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">

                 <li><a href="{{ url('/viewhall') }}">View Hall</a></li> 


                    <li class="Admission-menu"><a href="{{ url('admission') }}">Admission</a></li>
                   
                   
                 <!--
                    <li class="roompayment-menu"><a href="{{ url('roompayment') }}">Payment of Room</a></li>
-->
            
                   
                    <li class="studentdeposit-menu"><a href="{{ url('studentdeposit') }}">Deposit</a></li>

                    <li class="payment-menu"><a href="{{ url('studentpayment') }}">Room Payment</a></li>




                </ul>
            </li>
        




            <li class="Attendance-menu ">
                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Attendance</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
              
                    
                    <li class="addattendancereportstudents-menu "><a href="{{ url('addattendancereportstudents') }}">Attendance Reports</a></li>
                
                    

                    <!--<li class="examinationmarks_report-menu"><a href="examinationmarks_report.php">Students Marks</a></li>-->
                </ul>
            </li>




            <li class="MealManagement-menu">
                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Meal Management</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                

                   <li class="viewtodayfoodlist-menu"><a href="{{ url('viewtodayfoodlist') }}">Today Food list </a></li>
                   
                   
                </ul>
            </li>





            @endif


            @if(Auth::user()->userrole =='Employee')

<li class="StudentManagementbyadmin-menu">
    <a href="#"><i class="fa fa-graduation-cap"></i> <span class="nav-label">Student </span> <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
    <li><a href="{{ url('/viewhall') }}">View Hall</a></li> 
    
    
    <li class="Admission-menu"><a href="{{ url('admission') }}">Admission</a></li>

        <li class="pendinglist-menu"><a href="{{ url('pendingrequest') }}">Peding Request list</a></li>

        <li class="viewstudentlistrequest-menu"><a href="{{ url('viewstudentlist&request') }}">View Student List & Request</a></li>
        
        

        
    </ul>
</li>



<li class="Attendance-menu ">
                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Attendance</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                
                <li class="addattendance-menu "><a href="{{ url('addattendance') }}">Add Attendance </a></li>     
                <li class="addattendancereport-menu "><a href="{{ url('addattendancereport') }}">Attendance Reports</a></li>
                    

                    <!--<li class="examinationmarks_report-menu"><a href="examinationmarks_report.php">Students Marks</a></li>-->
                </ul>
            </li>
  
            <li class="MealManagement-menu">
                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Meal Management</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                

                   <li class="viewtodayfoodlist-menu"><a href="{{ url('viewtodayfoodlist') }}">Today Food list </a></li>
                   
                   
                </ul>
            </li>
            
            <li class="CostManagement-menu">
                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Cost Management</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="costentry-menu"><a href="{{ url('costentry') }}">Cost Entry</a></li>
                    <li class="costview-menu"><a href="{{ url('costview') }}">Cost View</a></li>
                    
                </ul>
            </li>










@endif











            @endif



        </ul>

    </div>
</nav>