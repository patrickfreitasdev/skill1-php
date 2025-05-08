This code was created for Skill assessment of Programming Essentials NIT using PHP.

Case scenario:

Maddington Library is a client of Superfast IT, and recently Michael Gibbs, the manager of Maddington Library, has contacted me for a software development project.

Maddington Library wants to develop a CLI-based simple library management project to digitalise Library Storage management. They have provided a user requirement document which I am attaching to this email.

I have set up your meeting with Michael Gibbs for next Tuesday. Before the meeting, please review the user requirement document. In the meeting, please interview Michael about his business needs and complete the client questionnaire.

Once all the information on the client questionnaire is completed, develop the software as per SuperFast IT’s standards.

# Maddington Library Management System

Maddington Library management system is designed to help to manage the books and its authors, the options included are:

- Create, delete and list books
- Add Author,
- Search Book, 
- Sort by ASC and DESC order

### Starting the application

To start the application, run the following command in your terminal:

`php index.php`

### File storage

All the data is stored in the storage folder as JSON format, it can be used to integrate with other platforms.

### JSON Structure

Book JSON Structure:

```
{
    "resourceId": "68186b0a8fe89",
    "resourceCategory": "book",
    "name": "System Engineering Analysis, Design, and Development: Concepts, Principles, and Practices",
    "isbn": "9781118442265",
    "publisher": "Wiley; 2nd edition (25 November 2015)",
    "author": {
        "authorId": "68186b4d7054a",
        "name": "Charles S. Wasson"
    }
}
```

Other Resource JSON structure:

```
{
    "resourceId": "6819aad685652",
    "resourceCategory": "harddisk",
    "res_name": "External hard disk",
    "res_description": "new hard disk for computer X",
    "res_brand": "samsung"
}
```