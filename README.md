# Welcome to Human Resources Laravel API
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

### Project status

![Badge](https://img.shields.io/static/v1?label=Framwork&message=Laravel&color=red&style=for-the-badge&logo=laravel) ![Badge](https://img.shields.io/static/v1?label=Language&message=PHP&color=blue&style=for-the-badge&logo=PHP) ![Badge](https://img.shields.io/static/v1?label=Database&message=MYSQL&color=blue&style=for-the-badge&logo=mysql) ![Badge](https://img.shields.io/static/v1?label=Project_Stage&message=in_progress&color=sucess&style=for-the-badge) 

### Index

1. [Abstract](#abstract)
2. [API Routes](#routes)
    1. [Auth routes](#authRoutes)
    2. [Admin routes](#adminRoutes)
    3. [Vacancy routes](#vacancyRoutes)
    4. [Candidate routes](#candidatesRoutes)
    5. [Technology routes](#technologyRoutes)
    6. [Diploma routes](#diplomaRoutes)
3. [About Laravel](#aboutLaravel)
4. [About MySQL](#aboutMySQL)

### 1. Abstract <a name="abstract">

Currently, the market demand by web developers pass by a high climax. Programmers that have skills in API development, API consume, experience in increment and fixing API routes and web systems are recruited for participate in selective and hiring processes. This project was done to one software enterprise how technical skills assessment. That API project was designed to demonstrate important development concepts using Laravel framework, PHP language, MySQL database, Sanctum (as auth users service) and outher third-part dependencies. The employed methodology to develope this API was Laravel documentation reading and searchs on StackOverflow website to solve doubts. Human resources API speak send data using JSON format and implements methods to image upload and storage, token generation, password encriptation, database structure saved as migration files, requests validation, entity models, their relationships and data pagination. The project results are very satisfying and objectivies are all goals have been achieved. 

### 2. API Routes <a name="routes"/>

Exists five main routes in this API: Admin, Candidate, Technology, Diploma and Vacancy. Using differents HTTP verbs, the clients softwares can requests the creation, reading, updating and deleting data about this entitys. JSON communication format was implemented to response requests.

#### Auth routes <a name="authRoutes"/>

| HTTP Verb |             Routes               |                             Description                          |                                    Required Params                                     |
|    --     |              --                  |                                  --                              |                                           --                                           |
|   POST    |  /admin/login                    | Generate a admin token, allowing login                           | Email, password                                                                        |
|   POST    |  /admin/revokeToken              | Admin logout, deleting their token                               | Token                                                                                  |
|   POST    |  /candidate/login                | Generate a candidate token, allowing login                       | Email, password                                                                        |
|   POST    |  /candidate/revokeToken          | Candidate logout, deleting their token                           | Token                                                                                  |


#### Admin routes <a name="adminRoutes"/>

| HTTP Verb |             Routes               |                             Description                          |                                    Required Params                                     |
|    --     |              --                  |                                  --                              |                                           --                                           |
| 	GET     |  /admin/{idAdmin}                | Paginate Admin data, limiting 5 admins per page                  | Token                                                                                  |
|   GET     |  /admin                          | Get data about especific admin                                   | Token                                                                                  |
|   POST    |  /admin                          | Create a new admin                                               | Token, img, name, email, password, post, created_by_admin (id admin creator)           |
|   POST    |  /admin/photo/{idAdmin}          | Change admin profile photo                                       | Token, img                                                                             |
|   POST    |  /admin/login                    | Generate a admin token, allowing login                           | Email, password                                                                        |
|   POST    |  /admin/revokeToken              | Admin logout, deleting their token                               | Token                                                                                  |
|   PUT     |  /admin                          | Change admin data                                                | Token, Token, img, name, email, password, post                                         |
|   PUT     |  /admin/changePassword/{idAdmin} | Change admin password, hashing and save in database              | Token, password                                                                        |
|   DELETE  |  /admin/{idAdmin}                | Delete admin                                                     | Token                                                                                  |

#### Vacancy routes <a name="vacancyRoutes"/>

| HTTP Verb |                          Routes                          |                                                   Description                                         |                                    Required Params                                     |
|    --     |                           --                             |                                                        --                                             |                                           --                                           |
| 	GET     |  /vacancy/applicable/{idCandidate}                       | Return vacancies that can be applied by user                                                          | Token, idCandidate                                                                     |
| 	GET     |  /vacancy/applied/{idCandidate}                          | Paginate candidate data also returning the technologies known to him, candidates and admin data       | Token, idCandidate                                                                     |
|   GET     |  /vacancy/{idVacancy}                                    | Get data about especific vacancy                                                                      | Token, idVacancy                                                                       |
|   GET     |  /vacancy                                                | Get vacancies that candidates can apply                                                               | Token                                                                                  |
|   POST    |  /vacancy                                                | Create a new vacancy                                                                                  | Token (admin), title, description, remote, hiring, technologies, admin_id              |
|   POST    |  /vacancy/apply                                          | Stores the individual's application                                                                   | Token, idCandidate, idVacancy                                                          |
|   PUT     |  /vacancy                                                | Allow edit vacancies data                                                                             | Token (admin), title, description, remote, hiring, technologies, admin_id              |
|   DELETE  |  /vacancy/{idVacancy}                                    | Delete a vacancy                                                                                      | Token (admin), idVacancy                                                               |


#### Candidate routes <a name="candidatesRoutes"/>

| HTTP Verb |                          Routes                          |                                                   Description                                         |                                    Required Params                                     |
|    --     |                           --                             |                                                        --                                             |                                           --                                           |
| 	GET     |  /candidate/vacancy/{idVacancy}                          | Return vacancy candidates with the technologies they know and their diplomas                          | Token                                                                                  |
| 	GET     |  /candidate/{idCandidate}                                | Paginate candidate data also returning the technologies known to him, limiting 15 candidates per page | Token                                                                                  |
|   GET     |  /candidate                                              | Get data about especific candidate                                                                    | Token                                                                                  |
|   POST    |  /candidate                                              | Create a new candidate                                                                                | Img, name, titration, email, password, birthDate, github, linkedin, notify_email       |
|   POST    |  /candidate/TechnologiesThatCandidateKnows/{idCandidate} | Sync technologies that candidate knows with database                                                  | Token, Technologies array (containing: idTechnology, name)                             |
|   POST    |  /candidate/photo/{idCandidate}                          | Change candidate profile photo                                                                        | Token, img                                                                             |
|   POST    |  /candidate/login                                        | Generate a candidate token, allowing login                                                            | Email, password                                                                        |
|   POST    |  /candidate/revokeToken                                  | Candidate logout, deleting their token                                                                | Token                                                                                  |
|   PUT     |  /candidate                                              | Change candidate data                                                                                 | Token, img, name, titration, email, birthDate, github, linkedin, notify_email          |
|   PUT     |  /candidate/changePassword/{idCandidate}                 | Change candidate password, hashing and save in database                                               | Token, password                                                                        |
|   DELETE  |  /candidate/{idCandidate}                                | Delete candidate                                                                                      | Token                                                                                  |


#### Technology routes <a name="technologyRoutes">

| HTTP Verb |                          Routes                          |                                                   Description                                         |                                    Required Params                                     |
|    --     |                           --                             |                                                        --                                             |                                           --                                           |
| 	GET     |  /technology/like/{searchedValue}                        | Until to search technologies in search fields                                                         | Token                                                                                  |
| 	GET     |  /technology/{idTechnology}                              | Returns data about a specific technology                                                              | Token                                                                                  |
|   GET     |  /technology                                             | Get data about all technologies                                                                       | Token                                                                                  |
|   GET     |  /technology/candidate/{idCandidate}                     | Get vacancies that candidates knows                                                                   | Token (admin)                                                                          |
|   POST    |  /technology                                             | Create a new technology                                                                               | Token (admin), description                                                             |
|   PUT     |  /technology/{idTechnology}                              | Allow edit technology description                                                                     | Token (admin), description                                                             |
|   DELETE  |  /technology/{idTechnology}                              | Delete a technology                                                                                   | Token (admin), idTechnology                                                            |

#### Diploma candidates routes <a name="diplomaRoutes">

| HTTP Verb |                          Routes                          |                                 Description                                    |                             Required Params                                |
|    --     |                           --                             |                                     --                                         |                                    --                                      |
|   GET     |  /diploma/candidate/{idCandidate}                        | Get candidate diplomas                                                         | Token, idCandidate                                                         |
|   POST    |  /diploma/candidate/{idCandidate}                        | Create a new candidate diploma                                                 | Token, idCandidate, course, institution, initial_date, final_date          |
|   PUT     |  /diploma/{idDiploma}                                    | Allow edit candidate diploma                                                   | Token, idCandidate, course, institution, initial_date, final_date          |
|   DELETE  |  /diploma/{idDiploma}                                    | Delete a candidate diploma                                                     | Token, idDiploma                                                           |

### 3. About laravel <a name="aboutLaravel">

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

\* The text above was automatically generated by laravel

### 4. About MySQL <a name="aboutMysql">

MySQL is a Database Management System (DMS), based on structured tables and entities relationship. This is the most famous database, maintained by Oracle according to Stack Overflow (SO) Survey 2020 [SO survey](https://insights.stackoverflow.com/survey/2020#technology-databases-all-respondents4). Software version used to construct this PHP class was MySQL Community version, available to download in: [MySQL Community Downloads](https://dev.mysql.com/downloads/)