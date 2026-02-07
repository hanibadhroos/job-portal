# Job Portal
It is a recruitment platform that supports three types of users: Admin, Companies, and Job Seekers.

Companies can publish and manage job postings, review applications, shortlist candidates, and communicate with them. Each company has its own dashboard.

Job seekers can browse and search for jobs, apply for suitable positions, and set up alerts for similar job opportunities.

The Admin manages all companies, job seekers, and job postings, and has the authority to delete any incorrect or inappropriate account or job listing.

---

##🚀 Features
- User Authentication (Email Verification)
- Multi-language Support (Arabic & English)
- Company Dashboard
- Job Posting & Applications
- Admin Panel
- Adding jobs alerts

---
## User Interface
<div>
    <img width="1366" height="641" alt="home page" src="https://github.com/user-attachments/assets/02a51281-2893-46ea-ab81-a02b57ace2f2" />
    <hr/>
    <img width="1366" height="638" alt="jobs page" src="https://github.com/user-attachments/assets/85df55eb-307c-4d45-81f0-918add4e14ef" />
     <hr/>
    <img width="1366" height="646" alt="login " src="https://github.com/user-attachments/assets/ec060276-c64d-4542-82b8-8e18e7683df4" />
     <hr/>
    <img width="1366" height="641" alt="register pag" src="https://github.com/user-attachments/assets/61a374b5-81a7-499b-beb9-89992dacd256" />
     <hr/>
    <img width="1366" height="638" alt="users manage for admin" src="https://github.com/user-attachments/assets/cb875cc6-5da3-4c03-857e-ef3d2e2c19bc" />
     <hr/>
    <img width="1366" height="639" alt="Company dashboard" src="https://github.com/user-attachments/assets/7ec2c543-4619-4290-bc34-f04e06f16530" />
     <hr/>
    <img width="1366" height="637" alt="companies manage for admin" src="https://github.com/user-attachments/assets/7013ff25-82db-4f66-a248-afc65c0bab4c" />
     <hr/>
    <img width="1366" height="633" alt="categories manage for admin" src="https://github.com/user-attachments/assets/42dc20d8-f282-477a-b781-a2d90e8c4ddc" />
     <hr/>


</div>

## 🛠 Tech Stack

Backend:
- Laravel 10
- MySQL
- RESTful API

Frontend:
- HTML, CSS, JavaScript
- Bootstrap 5

Other Tools:
- Git


## ⚙️ Installation

1. Clone the repository

```bash
git clone https://github.com/hanibadhroos/job-portal.git
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serv    
