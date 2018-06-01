# cen4010-s2018-group3
milestone0

CEN 4010 Principles of Software Engineering  Milestone 0: Development Infrastructure Setup and  Team Organization

Florida Atlantic University
Dr. Shihong Huang

Note: This is an individual assignment, unless specified otherwise.
Introduction
This milestone helps you to be familiar with the development infrastructures that will be used in this course’s term projects. While most of the work is to be done individually, you can work together with your team to complete the task.  In fact, working together is encouraged not only for M0, but also for your teamwork. However, for this Milestone 0, ultimately, each team member must do their own work and learn the tools used for the final team project.
In this milestone, you will learn: a) individual usage of tools; and b) most importantly, how to use the tools in team setting (e.g. code merging and collaborating etc.).
LAMP and MySQL account setup
Each student should have a LAMP server account and MySQL account. Your lamp server account path is: http://lamp.cse.fau.edu/~YouFAUID/
You should be familiar with on how to access LAMP server, how to load files to it, and how to connect your database
For Mac user, you can access LAMP server directly by using commend: ssh
For example, “ssh -l YourFAUID lamp.cse.fau.edu”
Windows users need to install software which allows them to communicate via SSH.  The recommended software for this is PuTTY, available at http://www.putty.org.  
I will create your team LAMP server account for you, to which you will deploy your team’s final project
GitHub Team (Private) Repo
The purpose of this part of the exercise is for you and your team to set up the team’s private GitHub repository that is going to be used for storing your team’s project and be accessible only to the team members (and instructors). Only one member needs to set up the private repository. 
As a first step, all team members need to have their own GitHub account. This is mandatory, NO EXCEPTIONS - see step below
Create private GitHub account
Creating GitHub Account if you do not have one. Skip this step if you already have an account. When creating the GitHub account, select that you will have public repos. DO NOT SELECT private repos, or you will be asked to enter credit card information.
Create team GitHub repo
Select one team member to create an organization/team repo. Organization's name should like cen4010-s2018-gXX and create the public Repo. Private repo takes money
Report your GitHub username and indicate who is the one creating the team's Repo in M0 document to be submitted
Invite all team members GitHub account to your team Repo
 Add TA’s GitHub account to your team’s Repo:     a.     TA’s username: hctao
You will later push the initial state of your team’s project to this Repo

Team members are strongly encouraged to practice creation of branches and code merge, which could be a problem when you give it the first try. Please consult online resources for GitHub best practices.
Create a team website and “About” page and practice code merge
The purpose of this part of the exercise is to get you to work individually to create a webpage within your team’s project context, and then to work with your team to join these pages together using your teams GitHub account and chosen framework into a single site. We recommend that you in fact create ABOUT webpage which introduces the team members. This can then be part of your final application and is great for your portfolio.
This practice is hence designed to help you learn your individual as well as team tasks in a typical software team project
Each individual in your team should clone the team’s private GitHub repository into his/her individual shell account or onto your local computer, and within the chosen team framework create a page that at a minimum displays their name and their or some other image (if you are comfortable it is good idea to use your own image which is useful for your ABOUT page and portfolio – this is of course optional).  Please make sure that you have the right to use that image. This work has to be completed by individual student and then pushed to the team’s private GitHub repository.  The file(s) created/added should then be merged into the team’s private GitHub repository. 
One of your teammates will need to modify your team’s home page to point to all the different team member’s pages. This account (your team’s LAMP server account) will be used to deploy your final term project.
This is the same way you will deploy your final application, hence it is useful to make sure you learn and test it, especially how to deal with branching and code merge. Every team member should and needs to understand how your team’s application is deployed and managed.
Create team collaboration and Scrum project management site – Trello
Go to https://trello.com, to create your team’s collaboration and Scrum project management space.
Invite Dr. Huang (shihong@fau.edu) and TA Haicheng Tao (htao2017@fau.edu) to your Trello work space.
Deliverables
All projects will be inspected and graded on the due date.  The key for grading will be your team’s webpage (step 4 above) which must be served from the public_html directory in your team’s project Linux shell and developed using the tools described above. Individual accounts will also be checked. Individual account must be pointed from your group’s account. Emphasis is on correctness (not so much on  design of the final team page) and proper usage of development tools. 
Give your team a name of your choice. List team members, team roles (e.g., Scrum Master, Product Owner, Development Teams – we will cover this in later lecture. Leave the roles empty if you don’t know yet)
Your Scrum practice management Trello: name and link.
A public link to your GitHub project repository
Your team’s website link at LAMP server
Submission
Submit the following to Canvas by the due date:
Put the above required deliverable information into a single word file
Submit to Canvas before the due date. Follow the submission link in Assignments
Each team submits only one copy
Grading Criteria
This assignment is worth 10% of your class grade, as indicated in the syllabus.  The grade for this assignment will be determined according to the following criteria:
Correct use of Git and GitHub					4 points
Correct team WWW page functionality, deployment		4 points
Correct created Trello work space			2 points	
