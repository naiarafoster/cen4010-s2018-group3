SET ECHO ON

-- Drop the tables if they are already there. 
-- OK to get an Oracle error if the table(s) not found (if running script for the first time)
drop table  COMMENT;
drop table  POST;
drop table  MEDIAUPLOAD;
drop table  PROBLEM_MANAGER;
drop table  GENERAL_USER;
drop table  NotificationID;


-- Create the tables, views, constraints, etc..

-- Create the COMMENT table
CREATE TABLE  COMMENT ( commentID 		VARCHAR(15), 
		    			UserID 	        VARCHAR(15), 
		    			PostID          VARCHAR(15), 
		    			Content 	    TEXT, 
                		Date_Time       TIMESTAMP,
						PRIMARY KEY (commentID),
                        FOREIGN KEY(UserID) 	REFERENCES GENERAL_USER ON DELETE CASCADE, 
                        FOREIGN KEY(PostID) 	REFERENCES POST ON DELETE CASCADE, 

	          		);

-- Create the POST table
CREATE TABLE  POST(  	PostID          VARCHAR(15), 
						UserID 	        VARCHAR(15),
						Title 	        VARCHAR(30), 
						Content 	     TEXT, 
                        Date_Time       TIMESTAMP,
                        Location1       LOCATION, 
                        EvenProblem    TYPE, 
						PRIMARY KEY(PostID),
                        FOREIGN KEY(UserID) 	REFERENCES GENERAL_USER ON DELETE CASCADE, 
		     		);

-- Create the MEDIA_UPLOAD table
CREATE TABLE  MEDIA_UPLOAD(MediaID 	VARCHAR(15),
                          UserID 	        VARCHAR(15),
                          PostID          VARCHAR(15),
                          Path1           PATH,
                          Date_Time       TIMESTAMP,
						  PRIMARY KEY(MediaID),
                          FOREIGN KEY(UserID) 	REFERENCES GENERAL_USER ON DELETE CASCADE, 
                          FOREIGN KEY(PostID) 	REFERENCES POST ON DELETE CASCADE, 

		    		);

-- Create the PROBLEM_MANAGER  table
CREATE TABLE PROBLEM_MANAGER  (	    UserID 	        VARCHAR(15),
                                    PostID          VARCHAR(15),
                                    Status_         STATUS, 
									PRIMARY KEY(UserID, PostID), 
				  					FOREIGN KEY(UserID) 	REFERENCES GENERAL_USER ON DELETE CASCADE, 
  				  					FOREIGN KEY(PostID) 	REFERENCES POST ON DELETE CASCADE, 
                                );

-- Create the GENERAL_USER   table
CREATE TABLE GENERAL_USER  (	    UserID 	        VARCHAR(15),
                                    UserName        VARCHAR(30),
                                    Password_       VARCHAR(15),
                                    Email           VARCHAR(320),
                                    Phone           NUMBER,
                                    Role_            VARCHAR(15),
									PRIMARY KEY(UserID), 
                                );


-- Create the NOTIFICATIONS  table
CREATE TABLE NOTIFICATIONS  (	    NotificationID  VARCHAR(15),
                                    UserID 	        VARCHAR(15),
                                    PostID          VARCHAR(15),
                                    Content         TEXT, 
                                    Type_           VARCHAR(15),
                                    Date_Time       TIMESTAMP,
									PRIMARY KEY(NotificationID), 
				  					FOREIGN KEY(UserID) 	REFERENCES GENERAL_USER ON DELETE CASCADE, 
  				  					FOREIGN KEY(PostID) 	REFERENCES POST ON DELETE CASCADE, 
                                );

-- Ensure all data is removed from the tables
truncate table COMMENT;
delete from POST;
delete from MEDIA_UPLOAD;
delete from PROBLEM_MANAGER;
delete from GENERAL_USER;
delete from NOTIFICATIONS;
