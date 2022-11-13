## GUEST MANAGEMENT
## 1.	Scope of Works
-	Giving gifts is a common tradition at Indian weddings. The traditional wedding gift is money, which is regarded as the most thoughtful gift for the couple to start their lives together. This is better done by placing money in a pretty envelope or embroidered bag, along with your best wishes.
-	Problem is that we need to check how much amount we have given in our guest event or how much amount we have received in the event. 
-	So, our portal will help to resolve this issue.
-	The purpose of this document is to create the manage Events module where users (after login) can manage the entire Events.
-	This is events management module used to manage (add / edit / delete / active/inactive) event for your site.
-	Our portal will be used to maintain a record of the gifts given to the guest by the host and also the gifts given by the guest to the host.
-	The portal will keep track of the guests who have attended the event and also the guests who have not attended the event.
-	The portal will also provide a report on the total amount of gifts given by the host and the total amount of gifts received by the host.
-	The portal will also provide a report on the total amount of gifts given by the guest and the total amount of gifts received by the guest.
-	The portal will also provide a list of the guests who have not given any gifts to the host.
-	The portal will also provide a list of the guests who have not received any gifts from the host.
## 1.1.	Backend (User Panel)
-	Create login screen for user to login and manage Events.
    -	Username and password MUST be authenticate from database
-	Create interface for user registration, you can enter username and password directly into the database.
-   After successful login, There will be following sections in users side, which can be managed by users 
-   Logout
## 1.2.	Front End
- Home Page
    - Display all events list and guests list
    - Main header Menu (Top menu) links
    - Information on the page of that events like location, expenses, total guests, food/drinks list.
- Events List
    - List down all Events which are active
    - Ability to search event based on title, date and location
    - Create detail page of each event
## 1.3.	Functional requirements: 
1.	Construct and maintain guest lists for events.
2.	Prepare invitations to events.
3.	Ensure that all guests are accounted for and that they have received their gifts.
4.	Handle event logistics.
5.	Manage event budget.
6.	Evaluate event effectiveness and submit post-event reports.
7.	Payment method should be integrate into the portal when any event is created after then there is option to add where you want to receive the payment from the guest like paytm QR code and on receive payment show guest details and paid amount in the portal, if guest is new than need to add guest and display special flag that differentiate its new guest.
8.	Portal also having an option to create or order event invitation cards.
9.	One Super Admin Portal that will manage all user that have use our portal.
10.	All user data store in our databases show huge data is available in our db so maintain the db we need to buy space or man power and its will be high cost in future so we need to be paid service after 10-15 guest or event created.
11.	We can also give the services free if user store all the data in local system or may be store all data in json format or this data we can store in client devices and they can also bkp this file in gdrive or as they want. 
12.	Import export Guest , event etc. 


## Function or Pages Available: 
-	Event CRUD
-	Guest CRUD
-	Send Invitation (Digital share card by social media or after printing distribute Invitation Cards )
-	Distribute Card (option distribute by itself or 3rd party or our portal)
-	Design Card (CRUD)
-	User Profile CRUD
## 1.4.	Non Functional requirements			
## 1.5.	Database Analysis
## 1.6.	Important Notes :

## Tech Stack

**Client:** HTML5, JS, Jquery, Ajax , Bootstrap 4
**Server:** phpv8.1 , Apache, mysql


## Support

For support, email info@garimarajput.com.

## License

[MIT](https://choosealicense.com/licenses/mit/)


## Installation

Install This project
```bash
    comming soon...
```

