\# Helpdesk Ticketing System



Technical test project using Laravel.



\## Features

\- Create ticket

\- Ticket status workflow (Open → On Progress → Resolved → Closed)

\- Ticket logs history

\- Filter tickets

\- Pagination

\- Role restriction (IT Support only)



\## Tech Stack

\- Laravel

\- MySQL

\- Bootstrap



\## Setup



1\. Clone repository

2\. Install dependency



composer install



3\. Copy env



cp .env.example .env



4\. Generate key



php artisan key:generate



5\. Setup database in .env



6\. Run migration



php artisan migrate --seed



7\. Run server



php artisan serve

