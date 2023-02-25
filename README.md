### Prerequisites

- XAMPP

### Installing project

1. Download the project files
2. Extract the files to your htdocs folder in XAMPP
3. Open XAMPP and start the Apache and MySQL modules
4. Open your web browser and navigate to http://localhost/phpmyadmin
5. Create a new database named onlineventure
6. Import the onlineventure.sql file from the /db folder into the onlineventure database
7. Open your web browser and navigate to http://localhost/onlineventure
8. Project should now be up and running

If you have different credentials than the default, you can change them in conn.php.

### API Endpoint
The following API endpoints are available:

#### Get article by some ID

- Method: GET

``http://localhost/onlineventure/api.php?endpoint=article&id={article_id}``

Example: ``http://localhost/onlineventure/api/article?id=1``

#### Get all articles for given author

- Method: GET

``http://localhost/onlineventure/api.php?endpoint=author&name={author_name}``

Example: ``http://localhost/onlineventure/api.php?endpoint=author&name=chris``

#### Get top 3 authors that wrote the most articles last week

- Method: GET

``http://localhost/onlineventure/api.php?endpoint=top_authors``

### Using
#### Add news
To add news, click on the "Add News" button on the homepage. This will take you to a form where you can enter the title, text, and author(s) of the news article. Now you can click on the "Save" button to add the news to the database.

#### Add author
To add author, click on the "Add Author" button on the homepage. This will take you to a form where you can enter the name of the author. Now you can click on the "Save" button to add the news to the database.

#### Edit news
To edit news, click on the "Edit" button next to the news article you want to edit. This will take you to a form where you can update the title, text, and author(s) of the news article. Now you can click on the "Save" button to update the news in the database.

#### Delete news
To delete news, click on the "Delete" button next to the news article you want to delete. 