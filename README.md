<h2>Chat assignment for Bunq</h2>
This repository contains the code I wrote as an assignment to be attached to my application as a Backend Engineer at Bunq.
In advance, I am sorry if the code quality is not up to your standarts, as I had to partially re-learn PHP on the go.
<br/>The structure is as follows:<br/>
- index.php - obviously enough, mostly consists of the routing-related code and high-level instructions of what has has to be done on each route<br/>
- src/ - Folder with the actual source code, contains two other folders - Configuration/ and Managers/<br/>
- Configuration/ - contains the configuration files for the project. In this specific instance, it only has one file - dbconfig.php, which describes the tables present in the database<br/>
- Managers/ - Contains two folders - DBManagers/ - the lower-level managers, which interact directly to the database using the shared baseDbManager.php; And LogicManagers/ - containing (as the name suggests) the logical layer of the application.
