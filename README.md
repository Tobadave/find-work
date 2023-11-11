# find-work

This app is  for ..........

## Features 
- Admin Panel
  - Normal Admin 

  - Social Panel
  
  ## Changes made on 11 November

  - Created a new employer.html file  
  - (you can change it to php, i was just editing)


  - created a new jobseeker.html file

  - edited the signup.php file to just (Email, password, and confirm password) but didnt touch the backend or logic files(php)

  - I also edited (deleted the columns no longer needed) the data structures in sql to (mail, pass, pass2) - for the signup fill in form

  - posting.html should be where any jobs posted to be seeen by the job seeker
  - application_form.php might noty just be neccessary again

<br>
-----------------------------------

### LINKING OF PAGES EXPLANATION

1 - signup ***( Email, password, confirm password)
	radio button to choose between- Employeer or JobSeeker
2 - login ***(with sign up data) Email, password.

	MAIN DATABASE TABLE ****{

3 - if radio = Employer
	***redirect to employer page
	(where there is another form to fill) --------------> ( EMPLOYEEER TABLE)
	-Employer name
	-User email --- this automatically fills up or same thing as the one used to signup
	-Company name
	-Company field
	-Location

	if radio = JobSeeker
	***redirect to jobseeker page
	(where there is another form to fill) --------------> ( JOB SEEKRER TABLE)
	-User email --- this automatically fills up or same thing as the one used to signup
	-Fisrt name
	-Last name
	-phone number
	-Skills
	-education history
	-resume link

4 - FOR Employer can post jobs that entails:  --------------> (JOB POSTING TABLE)
	-Title
	-description
	-location
	-resume link
	-salary
	-deadline
5 - FOR JobSeeker can apply to jobs that Employer posts
	
6 - 	--------------> ( TABLE)
	(i dont know how to implement the 'APPLICATION' as a database yet, or how it will store
	you can check the diagram i sent maybe youd know how. )

	}*****

