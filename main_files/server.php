<?php
session_start();
// initializing variables
$company_id="";
$company_name="";
$company_type="";
$website="";
$address2="";
$coming_date="";

$c_type="";
$branch1="";
$min_cgpa="";
$max_backlogs="";
$max_salary="";
$max_stipend="";
$job_profile="";
$place_of_posting="";

$student_id="";
$student_name="";
$father_name="";
$mother_name="";
$dob="";
$gender="";
$st_email="";
$address1="";
$contact_num="";
$branch="";
$tenth_per="";
$tenth_pass="";
$twelfth_per="";
$twelfth_pass="";
$cgpa="";
$pass="";
$backlogs="";
$apply="";
$st_password="";

$admin_id="";
$admin_name="";
$a_email="";
$post="";
$con_number="";
$dob2="";
$qualification="";

$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'placement');

// REGISTER USER
if (isset($_POST['reg_user'])) //??????????????//
{
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) 
	{ 
		array_push($errors, "Username is required"); 
	}
  if (empty($email)) 
	{ 
		array_push($errors, "Email is required"); 
	}
  if (empty($password_1)) 
	{ 
		array_push($errors, "Password is required"); 
	}
  if ($password_1 != $password_2) 
	{
	array_push($errors, "passwords do not match");
	}

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM login WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  //The mysqli_fetch_assoc() function fetches a result row as an associative array.
  $user = mysqli_fetch_assoc($result);
  
  if ($user)
{ // if user exists
    if ($user['username'] === $username) 
	{
      array_push($errors, "Username already exists");
    }
    if ($user['email'] === $email) 
	{
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) 
  {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO login (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "Successfully registered";
  	header('location: index.php');
  }
}

// ... 
// LOGIN USER
if (isset($_POST['login_user'])) //?????????????
{
//The mysqli_real_escape_string() function escapes special characters in a string for use in an SQL statement.
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  if (empty($username)) 
  {
    array_push($errors, "Username is required");
  }
  if (empty($password)) 
  {
    array_push($errors, "Password is required");
  }
  if (count($errors) == 0) 
  {
//The md5() function calculates the MD5 hash of a string
    $password = md5($password);
	$query = "SELECT * FROM login WHERE username='$username' AND password='$password'";
	//The mysqli_query() function performs a query against the database.
	
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) ////Return the number of rows in a result set:
	{
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";
      header('location: index.php');
    }
	else 
	{
      array_push($errors, "Wrong username/password combination");
    }
  }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// REGISTER Admin
if (isset($_POST['reg_admin'])) //??????????????//
{
  // receive all input values from the form
  $admin_id = mysqli_real_escape_string($db, $_POST['admin_id']);
  $admin_name = mysqli_real_escape_string($db, $_POST['admin_name']);
  $post = mysqli_real_escape_string($db, $_POST['post']);
  $con_number = mysqli_real_escape_string($db, $_POST['con_number']);
  $dob2 = mysqli_real_escape_string($db, $_POST['dob2']);
  $qualification = mysqli_real_escape_string($db, $_POST['qualification']);
  $a_email = mysqli_real_escape_string($db, $_POST['a_email']);
  $admin_password1 = mysqli_real_escape_string($db, $_POST['admin_password1']);
  $admin_password2 = mysqli_real_escape_string($db, $_POST['admin_password2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($admin_name)) 
	{ 
		array_push($errors, "Username is required"); 
	}
	if (empty($admin_id)) 
	{ 
		array_push($errors, "Id is required"); 
	}
  if (empty($a_email)) 
	{ 
		array_push($errors, "Email is required"); 
	}
  if (empty($admin_password1)) 
	{ 
		array_push($errors, "Password is required"); 
	}
  if ($admin_password1 != $admin_password2) 
	{
	array_push($errors, "passwords do not match");
	}

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM admin WHERE ADMIN_NAME='$admin_name' OR EMAIL='$a_email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  //The mysqli_fetch_assoc() function fetches a result row as an associative array.
  $user = mysqli_fetch_assoc($result);
  
  if ($user)
{ // if user exists
    if ($user['ADMIN_NAME'] === $admin_name) 
	{
      array_push($errors, "Username already exists");
    }
    if ($user['EMAIL'] === $a_email) 
	{
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) 
  {
  	$password = md5($admin_password1);//encrypt the password before saving in the database

  	$query = "INSERT INTO admin (ADMIN_ID,ADMIN_NAME,A_PASSWORD,POST,EMAIL,CONTACT_NO,DOB,QUALIFICATION) 
  			  VALUES('$admin_id', '$admin_name', '$password', '$post', '$a_email', '$con_number', '$dob2', '$qualification')";
  	mysqli_query($db, $query);
  	$_SESSION['admin_nmae'] = $admin_name;
  	$_SESSION['success'] = "Successfully registered admin";
  	header('location: index_admin.php');
  }
}

// LOGIN Admin
if (isset($_POST['login_admin'])) //?????????????
{
	
//The mysqli_real_escape_string() function escapes special characters in a string for use in an SQL statement.
    
	
  $admin_name = mysqli_real_escape_string($db, $_POST['admin_name']);
  $admin_id = mysqli_real_escape_string($db, $_POST['admin_id']);
  $admin_password = mysqli_real_escape_string($db, $_POST['admin_password']);

  if (empty($admin_name)) 
  {
    array_push($errors, "Username is required");
  }
  if (empty($admin_id)) 
  {
    array_push($errors, "Id is required");
  }
  if (empty($admin_password)) 
  {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) 
  {
//The md5() function calculates the MD5 hash of a string
    $password = md5($admin_password);
	$query = "SELECT * FROM admin WHERE ADMIN_NAME='$admin_name' AND A_PASSWORD='$password' AND ADMIN_ID='$admin_id'";
	//The mysqli_query() function performs a query against the database.
    $results = mysqli_query($db, $query);
	
    if (mysqli_num_rows($results) == 1) ////Return the number of rows in a result set:
	{
      $_SESSION['admin_name'] = $admin_name;
      $_SESSION['success'] = "Admin logged in";
      header('location: index_admin.php');
    }
	else 
	{
      array_push($errors, "Wrong username/password combination");
    }
  }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// REGISTER Student
if (isset($_POST['reg_student'])) 
{
  // receive all input values from the form
  $student_id = mysqli_real_escape_string($db, $_POST['student_id']);
  $student_name = mysqli_real_escape_string($db, $_POST['student_name']);
  $father_name = mysqli_real_escape_string($db, $_POST['father_name']);
  $mother_name = mysqli_real_escape_string($db, $_POST['mother_name']);
  $dob = mysqli_real_escape_string($db, $_POST['dob']);
  $gender = mysqli_real_escape_string($db, $_POST['gender']);
  $st_email = mysqli_real_escape_string($db, $_POST['st_email']);
  $address1 = mysqli_real_escape_string($db, $_POST['address1']);
  $contact_num = mysqli_real_escape_string($db, $_POST['contact_num']);
  $branch = mysqli_real_escape_string($db, $_POST['branch']);
  $tenth_per = mysqli_real_escape_string($db, $_POST['tenth_per']);
  $tenth_pass = mysqli_real_escape_string($db, $_POST['tenth_pass']);
  $twelfth_per = mysqli_real_escape_string($db, $_POST['twelfth_per']);
  $twelfth_pass = mysqli_real_escape_string($db, $_POST['twelfth_pass']);
  $cgpa = mysqli_real_escape_string($db, $_POST['cgpa']);
  $pass = mysqli_real_escape_string($db, $_POST['pass']);
  $backlogs = mysqli_real_escape_string($db, $_POST['backlogs']);
  $apply = mysqli_real_escape_string($db, $_POST['apply']);
  $st_password1 = mysqli_real_escape_string($db, $_POST['st_password1']);
  $st_password2 = mysqli_real_escape_string($db, $_POST['st_password2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($student_name)) 
	{ 
		array_push($errors, "Student Name is required"); 
	}
	if (empty($student_id)) 
	{ 
		array_push($errors, "Student Id is required"); 
	}
  if (empty($st_email)) 
	{ 
		array_push($errors, "Email is required"); 
	}
  if (empty($st_password1)) 
	{ 
		array_push($errors, "Password is required"); 
	}
  if ($st_password1 != $st_password2) 
	{
	array_push($errors, "passwords do not match");
	}
	if (empty($father_name)) 
	{ 
		array_push($errors, "Father's name is required"); 
	}
	if (empty($mother_name)) 
	{ 
		array_push($errors, "Mother's name is required"); 
	}
  if (empty($gender)) 
	{ 
		array_push($errors, "Gender is required"); 
	}
  if (empty($dob)) 
	{ 
		array_push($errors, "Date of birth is required"); 
	}
	if (empty($branch)) 
	{ 
		array_push($errors, "Branch is required"); 
	}
	if (empty($cgpa)) 
	{ 
		array_push($errors, "cgpa is required"); 
	}
  

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM student WHERE STUDENT_NAME='$student_name' OR STUDENT_ID='$student_id'  LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  //The mysqli_fetch_assoc() function fetches a result row as an associative array.
  $user = mysqli_fetch_assoc($result);
  
  if ($user)
{ // if user exists
    if ($user['STUDENT_NAME'] === $student_name) 
	{
      array_push($errors, "Student already registered");
    }
	if ($user['STUDENT_ID'] === $student_id) 
	{
      array_push($errors, "Id already exists");
    }
    if ($user['EMAIL'] === $st_email) 
	{
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) 
  {
  	$password = md5($st_password1);//encrypt the password before saving in the database

  	$query = "INSERT INTO student (STUDENT_ID,S_PASSWORD,STUDENT_NAME,FATHER_NAME,MOTHER_NAME,GENDER,DOB,EMAIL,ADDRESS,CONTACT_NO,BRANCH,TENTH_PER,TENTH_PASS_YEAR,TWELTH_PER,TWELTH_PASS_YEAR,CGPA,PASSING_YEAR,BACKLOGS,APPLY_FOR) 
  			  VALUES('$student_id', '$password', '$student_name', '$father_name', '$mother_name', '$gender', '$dob', '$st_email', '$address1', '$contact_num', '$branch', '$tenth_per', '$tenth_pass', '$twelfth_per', '$twelfth_pass', '$cgpa', '$pass', '$backlogs','$apply')";
  	mysqli_query($db, $query);
  	$_SESSION['student_name'] = $student_name;
  	$_SESSION['success'] = "Student registered successfully";
  	header('location:student.php');
  }
}

// LOGIN Student Intern
if (isset($_POST['login_student_int'])) //?????????????
{
	
//The mysqli_real_escape_string() function escapes special characters in a string for use in an SQL statement.
  $student_name = mysqli_real_escape_string($db, $_POST['student_name']);
  $student_id = mysqli_real_escape_string($db, $_POST['student_id']);
  $apply = mysqli_real_escape_string($db, $_POST['apply']);
  $st_password = mysqli_real_escape_string($db, $_POST['st_password']);

  if (empty($student_name)) 
  {
    array_push($errors, "Student Name is required");
  }
  if (empty($student_id)) 
  {
    array_push($errors, "Student Id is required");
  }
  if (empty($st_password)) 
  {
    array_push($errors, "Password is required");
  }
  if(($apply!='internship' and $apply!='Internship' and $apply!='intern' and $apply!='Intern' ))
  {
	  array_push($errors, "You entered incorrect information for Apply");
  }

  if (count($errors) == 0 ) 
  {
//The md5() function calculates the MD5 hash of a string
    $password = md5($st_password);
	$query = "SELECT * FROM student WHERE STUDENT_NAME='$student_name' AND S_PASSWORD='$password' AND STUDENT_ID='$student_id' AND APPLY_FOR='$apply'";
	//The mysqli_query() function performs a query against the database.
    $results = mysqli_query($db, $query);
	
    if (mysqli_num_rows($results) == 1 ) ////Return the number of rows in a result set:
	{
      $_SESSION['student_name'] = $student_name;
      $_SESSION['success'] = "Student logged in for intern";
      header('location: index_student_intern.php');
    }
	else 
	{
      array_push($errors, "Wrong username/password combination");
    }
  }
}


// LOGIN Student Placement
if (isset($_POST['login_student_place'])) //?????????????
{
	
//The mysqli_real_escape_string() function escapes special characters in a string for use in an SQL statement.
  $student_name = mysqli_real_escape_string($db, $_POST['student_name']);
  $student_id = mysqli_real_escape_string($db, $_POST['student_id']);
  $apply = mysqli_real_escape_string($db, $_POST['apply']);
  $st_password = mysqli_real_escape_string($db, $_POST['st_password']);

  if (empty($student_name)) 
  {
    array_push($errors, "Student Name is required");
  }
  if (empty($student_id)) 
  {
    array_push($errors, "Student Id is required");
  }
  if (empty($st_password)) 
  {
    array_push($errors, "Password is required");
  }
  if(($apply!='placement' and $apply!='Placement' ))
  {
	  array_push($errors, "You entered incorrect info for Apply");
  }

  if (count($errors) == 0 ) 
  {
//The md5() function calculates the MD5 hash of a string
    $password = md5($st_password);
	$query = "SELECT * FROM student WHERE STUDENT_NAME='$student_name' AND S_PASSWORD='$password' AND STUDENT_ID='$student_id' AND APPLY_FOR='$apply'";
	//The mysqli_query() function performs a query against the database.
    $results = mysqli_query($db, $query);
	
    if (mysqli_num_rows($results) == 1 ) ////Return the number of rows in a result set:
	{
      $_SESSION['student_name'] = $student_name;
      $_SESSION['success'] = "Student logged in for Placement";
      header('location: index_student_placement.php');
    }
	else 
	{
      array_push($errors, "Wrong username/password combination");
    }
  }
}
/////////////////////////////////////////////////////////////////////////////////////

// REGISTER Company
if (isset($_POST['reg_comp'])) //??????????????//
{
  // receive all input values from the form
  $company_id = mysqli_real_escape_string($db, $_POST['company_id']);
  $company_name = mysqli_real_escape_string($db, $_POST['company_name']);
  $website = mysqli_real_escape_string($db, $_POST['website']);
  $address2 = mysqli_real_escape_string($db, $_POST['address2']);
  $coming_date = mysqli_real_escape_string($db, $_POST['coming_date']);
  $c_password1 = mysqli_real_escape_string($db, $_POST['c_password1']);
  $c_password2 = mysqli_real_escape_string($db, $_POST['c_password2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($company_name)) 
	{ 
		array_push($errors, "Company name is required"); 
	}
	if (empty($company_id)) 
	{ 
		array_push($errors, "Company Id is required"); 
	}
  if (empty($c_password1)) 
	{ 
		array_push($errors, "Password is required"); 
	}
  if ($c_password1 != $c_password2) 
	{
	array_push($errors, "passwords do not match");
	}

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM company WHERE COMPANY_NAME='$company_name' AND COMPANY_ID='$company_id' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  //The mysqli_fetch_assoc() function fetches a result row as an associative array.
  $user = mysqli_fetch_assoc($result);
  
  if ($user)
{ // if user exists
    if ($user['COMPANY_NAME'] === $company_name) 
	{
      array_push($errors, "Company name already exists");
    }
    if ($user['COMPANY_ID'] === $company_id) 
	{
      array_push($errors, "Company Id already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) 
  {
  	$password = md5($c_password1);//encrypt the password before saving in the database

  	$query = "INSERT INTO COMPANY (COMPANY_ID,COMPANY_NAME,C_PASSWORD,WEBSITE,ADDRESS,COMING_DATE) 
  			  VALUES('$company_id', '$company_name', '$password', '$website', '$address2', '$coming_date')";
  	mysqli_query($db, $query);
  	$_SESSION['company_name'] = $company_name;
  	$_SESSION['success'] = "Company Successfully registered";
  	header('location: index_company.php');
  }
}

// LOGIN Company
if (isset($_POST['login_company'])) //?????????????
{
	
//The mysqli_real_escape_string() function escapes special characters in a string for use in an SQL statement.
    
	
  $company_name = mysqli_real_escape_string($db, $_POST['company_name']);
  $company_id = mysqli_real_escape_string($db, $_POST['company_id']);
  $c_password = mysqli_real_escape_string($db, $_POST['c_password']);

  if (empty($company_name)) 
  {
    array_push($errors, "Company name is required");
  }
  if (empty($company_id)) 
  {
    array_push($errors, "Company Id is required");
  }
  if (empty($c_password)) 
  {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) 
  {
//The md5() function calculates the MD5 hash of a string
    $password = md5($c_password);
	$query = "SELECT * FROM company WHERE COMPANY_NAME='$company_name' AND C_PASSWORD='$password' AND COMPANY_ID='$company_id'";
	//The mysqli_query() function performs a query against the database.
    $results = mysqli_query($db, $query);
	
    if (mysqli_num_rows($results) == 1) ////Return the number of rows in a result set:
	{
      $_SESSION['company_name'] = $company_name;
      $_SESSION['success'] = "Comapny logged in";
      header('location: index_company.php');
    }
	else 
	{
      array_push($errors, "Wrong username/password combination");
    }
  }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// REGISTER Company Details

if (isset($_POST['reg_company_details'])) //??????????????//
{
  // receive all input values from the form
  $company_name = mysqli_real_escape_string($db, $_POST['company_name']);
  $c_type = mysqli_real_escape_string($db, $_POST['c_type']);
  $branch1 = mysqli_real_escape_string($db, $_POST['branch1']);
  $min_cgpa = mysqli_real_escape_string($db, $_POST['min_cgpa']);
  $max_backlogs = mysqli_real_escape_string($db, $_POST['max_backlogs']);
  $max_salary = mysqli_real_escape_string($db, $_POST['max_salary']);
  $max_stipend = mysqli_real_escape_string($db, $_POST['max_stipend']);
  $job_profile = mysqli_real_escape_string($db, $_POST['job_profile']);
  $place_of_posting = mysqli_real_escape_string($db, $_POST['place_of_posting']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($company_name)) 
	{ 
		array_push($errors, "Company name is required"); 
	}
	if (empty($c_type)) 
	{ 
		array_push($errors, "company type is required"); 
	}
	if (empty($branch1)) 
	{ 
		array_push($errors, "Branch is required"); 
	}
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM companybranch WHERE COMPANY_NAME='$company_name' AND C_TYPE='$c_type' AND BRANCH='$branch1' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  //The mysqli_fetch_assoc() function fetches a result row as an associative array.
  $user = mysqli_fetch_assoc($result);
  
  if ($user)
{ // if user exists
    if ($user['COMPANY_NAME'] === $company_name) 
	{
      array_push($errors, "Company name already exists");
    }
    if ($user['C_TYPE'] === $c_type) 
	{
      array_push($errors, "Company Type already exists");
    }
	if ($user['BRANCH'] === $branch1) 
	{
      array_push($errors, "Branch already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) 
  {
  	$query = "INSERT INTO companybranch (COMPANY_NAME,C_TYPE,BRANCH,MIN_CGPA,MAX_BACKLOGS,MAX_SALARY,MAX_STIPEND,JOB_PROFILE,PLACE_OF_POSTING) 
  			  VALUES('$company_name', '$c_type', '$branch1', '$min_cgpa', '$max_backlogs', '$max_salary', '$max_stipend', '$job_profile', '$place_of_posting')";
  	mysqli_query($db, $query);
  	$_SESSION['company_name'] = $company_name;
  	$_SESSION['success'] = "Company Successfully updated details";
  	header('location: index_company.php');
  }
  
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





?>