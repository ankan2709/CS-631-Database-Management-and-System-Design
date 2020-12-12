DROP DATABASE IF EXISTS citylibrary;
CREATE DATABASE IF NOT EXISTS citylibrary;
USE citylibrary;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `AdminEmail` varchar(120) DEFAULT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `admin` (`id`, `FullName`, `AdminEmail`, `UserName`, `Password`, `updationDate`) VALUES
(001, 'Ankan Dash', 'ankan@gmail.com', 'admin', '0192023a7bbd73250516f069df18b500', sysdate());



# READER
DROP TABLE IF EXISTS READER;
CREATE TABLE READER (
    RID INT AUTO_INCREMENT PRIMARY KEY,
    RTYPE VARCHAR(50),
    RNAME VARCHAR(50),
    RADDRESS VARCHAR(200),
    PHONE_NO VARCHAR(13)
);

INSERT INTO `READER` (`RID`, `RNAME`, `RTYPE`, `PHONE_NO`, `RADDRESS`) VALUES
(1, 'Maria', 'Student', '98652555', '615 Pavonia Ave'),
(2, 'Kavitha', 'Staff', '85690025', '97 Hudson St'),
(3, 'Karen', 'Senior Citizen', '59874527', '309 Sussex St'),
(4, 'Harshitha', 'Other', '585856224', '127 Warren St'),
(5, 'Ankan', 'Student', '672423754', '739 Harrison Av'),
(6, 'Akash', 'Student', '672432754', '250 Harrison Av')
;

# RESERVATION
DROP TABLE IF EXISTS RESERVATION;
CREATE TABLE RESERVATION (
    RES_NO INT AUTO_INCREMENT PRIMARY KEY,
    DTIME DATETIME
);


INSERT INTO `RESERVATION` (`RES_NO`,`DTIME`) VALUES
(1,sysdate()),
(2,sysdate()),
(3,sysdate()),
(4,sysdate()),
(5,sysdate()),
(6,sysdate());


# BORROWING
DROP TABLE IF EXISTS BORROWING;
CREATE TABLE BORROWING (
    BOR_NO INT AUTO_INCREMENT PRIMARY KEY,
    BDTIME DATETIME,
    RDTIME DATETIME
);


INSERT INTO `BORROWING` (`BOR_NO`,`BDTIME`,RDTIME) VALUES
(1, '2020-01-15', '2020-01-30'),
(2, '2020-01-15', '2020-01-30'),
(3, '2020-01-15', NULL),
(4, '2020-01-15', '2020-01-30'),
(5, '2020-01-15', NULL),
(6, '2020-01-15', NULL);



# BRANCH
DROP TABLE IF EXISTS BRANCH;
CREATE TABLE BRANCH (
    BID INT AUTO_INCREMENT PRIMARY KEY,
    LNAME VARCHAR(50),
    LOCATION VARCHAR(50)
);


INSERT INTO `branch` (`BID`, `LNAME`, `LOCATION`) VALUES
(1, 'Oklahoma City', 'Ap #671-247 Eget Ave'),
(2, 'Kingussie', 'Ap #115-3145 Magna. Avenue'),
(3, 'Spruce Grove', '9115 Sed Road'),
(4, 'Waiuku', '659-4785 Turpis St.'),
(5, 'Buizingen', 'P.O. Box 354, 6610 Facilisis St.'),
(6, 'Varna/Vahrn', '8949 Eu Street'),
(7, 'Chanco', '3980 Nullam Ave'),
(8, 'Rimbey', '8799 Laoreet Ave'),
(9, 'Quedlinburg', '5163 A, Street'),
(10, 'Abbateggio', '4463 Ut St.'),
(11, 'Turriaco', 'P.O. Box 935, 9142 Amet St.'),
(12, 'Rio Marina', 'P.O. Box 230, 4429 Orci Road'),
(13, 'Carleton', 'Ap #459-2446 Non, Avenue'),
(14, 'Midlands', 'P.O. Box 152, 8543 Pede. Av.'),
(15, 'San Diego', '3780 At, Av.'),
(16, 'Sargodha', 'P.O. Box 667, 7201 Aliquam Avenue'),
(17, 'Notre-Dame-du-Nord', '155-8151 Vestibulum Rd.'),
(18, 'Irricana', '7069 Habitant Road'),
(19, 'Pangnirtung', 'P.O. Box 940, 6860 Ut Rd.'),
(20, 'Aartrijke', 'Ap #404-322 Etiam Rd.');

# PUBLISHER
DROP TABLE IF EXISTS PUBLISHER;
CREATE TABLE PUBLISHER (
    PUBLISHERID INT AUTO_INCREMENT PRIMARY KEY,
    PUBNAME VARCHAR(50),
    ADDRESS VARCHAR(100)
);


INSERT INTO `PUBLISHER` (`PUBLISHERID`, `PUBNAME`,ADDRESS) VALUES
(1, 'SCHOLASTIC','610 Pavonia Ave'),
(2, 'McGraw-Hill Education','23 CLIFTON PLACE'),
(3, 'Wiley','23 ST'),
(4, 'Macmillian','65 LEXINGTON'),
(5, 'Oxford','22 BENTLY'),
(6, 'Pearson','123 STREET'),
(7, 'Penguin Random','124 GROVE ST'),
(8, 'Harper Collins','22 Harrison AVE'),
(9, 'Three Rivers Press','12 NEWARK'),
(10, 'Elsevier','22 HOBOKEN');


# PERSON
DROP TABLE IF EXISTS PERSON;
CREATE TABLE PERSON (
    PID INT AUTO_INCREMENT PRIMARY KEY,
    PNAME VARCHAR(50)
);


INSERT INTO `PERSON` (`PID`, `PNAME`) VALUES
(1, 'Genevieve Farrell'),
(2, 'Ashely Thornton'),
(3, 'Rhiannon Rush'),
(4, 'Ivy Campbell'),
(5, 'Tanek Beasley'),
(6, 'Leroy Melton'),
(7, 'Colton Banks'),
(8, 'Kato Valenzuela'),
(9, 'Chaney Brock'),
(10, 'Mira Jensen'),
(11, 'Odessa Rocha'),
(12, 'Dan Mallory'),
(13, 'Stephen Jones'),
(14, 'Lou Aronica'),
(15, 'Lester Ray');


# DOCUMENT
DROP TABLE IF EXISTS DOCUMENT;
CREATE TABLE DOCUMENT (
    DOCID INT AUTO_INCREMENT PRIMARY KEY,
    TITLE VARCHAR(50),
    PDATE DATE,
    PUBLISHERID INT,
    FOREIGN KEY (PUBLISHERID)
        REFERENCES PUBLISHER (PUBLISHERID)
        ON DELETE CASCADE
);


INSERT INTO `document` (`DOCID`, `TITLE`, `PDATE`, `PUBLISHERID`) VALUES
(1, 'Goosebumps Part 1', '2002-07-22', 1),
(2, 'Harry Potter - The Sorcers Stone', '2001-01-14', 5),
(3, 'Stephen King Biography', '2005-08-06', 3),
(4, 'Spider Man ', '2005-08-20', 8),
(5, 'Song Of Ice and Fire', '2018-07-19', 6),
(6, 'Julius caesar', '2002-09-22', 5),
(7, 'MahaBharata', '2018-08-2', 9),
(8, 'Ramayana', '2018-07-12', 9),
(9, 'Integral Mathematics', '2018-07-22', 4),
(10, 'Physics', '2018-05-18', 2);
/*(11, 'Elsevier - Neural Networks', '2002-07-22', 1),
(12, 'IEEE - Machine Learning', '2001-01-14', 5),
(13, 'Oxford University Press - Bioinformatics', '2005-08-06', 3),
(14, 'Springer - Information Technology ', '2018-08-20', 8),
(15, 'Microtome - Machine Learning', '2018-07-19', 6),
(16, 'Elsevier', '2018-07-22', 1),
(17, 'IEEE', '2018-01-14', 5),
(18, 'Oxford University Press', '2005-08-06', 3),
(19, 'Springer', '2005-08-20', 8),
(20, 'Microtome', '2018-07-19', 6);
*/


# COPY
DROP TABLE IF EXISTS COPY;
CREATE TABLE COPY (
    DOCID INT,
    COPYNO INT,
    BID INT,
    POSITION VARCHAR(20),
    PRIMARY KEY (DOCID , COPYNO , BID),
    FOREIGN KEY (DOCID)
        REFERENCES DOCUMENT (DOCID)
        ON DELETE CASCADE,
    FOREIGN KEY (COPYNO)
        REFERENCES BRANCH (BID)
        ON DELETE CASCADE
);


INSERT INTO `COPY` (`DOCID`,`COPYNO`, `BID`, `POSITION`) VALUES
(1,  1, 2, '001A03'),
(2, 2, 4, '001B09'),
(3, 3, 3, '001C08'),
(4,  4, 2, '001D05'),
(5,  5, 2, '001E03'),
(6, 6, 2, '001A05');


# RESERVES
DROP TABLE IF EXISTS RESERVES;
CREATE TABLE RESERVES (
    RID INT,
    RESERVATION_NO INT,
    DOCID INT,
    COPYNO INT,
    BID INT,
    PRIMARY KEY (RESERVATION_NO , DOCID , COPYNO , BID),
    FOREIGN KEY (DOCID , COPYNO , BID)
        REFERENCES COPY (DOCID , COPYNO , BID)
        ON DELETE CASCADE,
    FOREIGN KEY (RESERVATION_NO)
        REFERENCES RESERVATION (RES_NO)
        ON DELETE CASCADE,
    FOREIGN KEY (RID)
        REFERENCES READER (RID)
        ON DELETE CASCADE
);


INSERT INTO `RESERVES` (`RESERVATION_NO`,`RID`, `DocId`, `CopyNo`, `BID`) VALUES
(1, 1, 1, 1, 2),
(2, 2, 2, 2, 4),
(3, 3, 3, 3, 3),
(4, 4, 4, 4, 2),
(5, 5, 5, 5, 2),
(6, 6, 6, 6, 2);


# BORROWS
DROP TABLE IF EXISTS BORROWS;
CREATE TABLE BORROWS (
    BOR_NO INT,
    DOCID INT,
    COPYNO INT,
    BID INT,
    RID INT,
    PRIMARY KEY (BOR_NO , DOCID , COPYNO , BID),
    FOREIGN KEY (DOCID , COPYNO , BID)
        REFERENCES COPY (DOCID , COPYNO , BID)
        ON DELETE CASCADE,
    FOREIGN KEY (BOR_NO)
        REFERENCES BORROWING (BOR_NO)
        ON DELETE CASCADE,
    FOREIGN KEY (RID)
        REFERENCES READER (RID)
        ON DELETE CASCADE
);


INSERT INTO `borrows` (`BOR_NO`,`RID`, `DOCID`, `COPYNO`, `BID`) VALUES
(1, 1, 1, 1, 2),
(2, 2, 2, 2, 4),
(3, 3, 3, 3, 3),
(4, 4, 4, 4, 2),
(5, 5, 5, 5, 2),
(6, 6, 6, 6, 2);


# BOOK
DROP TABLE IF EXISTS BOOK;
CREATE TABLE BOOK (
    DOCID INT PRIMARY KEY,
    ISBN VARCHAR(50),
    FOREIGN KEY (DOCID)
        REFERENCES DOCUMENT (DOCID)
        ON DELETE CASCADE
);


INSERT INTO `BOOK` (`DocId`, `ISBN`) VALUES
(1, '0-1234-23456'),
(2, '1-2345-67543'),
(3, '7-4325-98076'),
(4, '3-4325-93465'),
(5, '5-2342-23435'),
(6, '6-7976-98766'),
(7, '6-7976-98763'),
(8, '6-7976-9876'),
(9, '5-2342-23435'),
(10,'5-2342-23435');


# AUTHORS
DROP TABLE IF EXISTS AUTHORS;
CREATE TABLE AUTHORS (
    PID INT,
    DOCID INT,
    PRIMARY KEY (PID , DOCID),
    FOREIGN KEY (PID)
        REFERENCES PERSON (PID)
        ON DELETE CASCADE,
    FOREIGN KEY (DOCID)
        REFERENCES BOOK (DOCID)
        ON DELETE CASCADE
);

INSERT INTO `AUTHORS` (`PID`, `DOCID`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10,10);

# JOURNAL_VOLUME
DROP TABLE IF EXISTS JOURNAL_VOLUME;
CREATE TABLE JOURNAL_VOLUME (
    DOCID INT PRIMARY KEY,
    VOLUME_NO INT,
    EDITOR INT,
    FOREIGN KEY (DOCID)
        REFERENCES DOCUMENT (DOCID)
        ON DELETE CASCADE,
    FOREIGN KEY (EDITOR)
        REFERENCES PERSON (PID)
        ON DELETE CASCADE
);


INSERT INTO `JOURNAL_VOLUME` (`DOCID`,VOLUME_NO,EDITOR) VALUES
( 8,1,1),
( 9,2,2),
(10,3,3);


# JOURNAL_ISSUE
DROP TABLE IF EXISTS JOURNAL_ISSUE;
CREATE TABLE JOURNAL_ISSUE (
    DOCID INT,
    ISSUE_NO INT,
    SCOPE VARCHAR(100),
    PRIMARY KEY (DOCID , ISSUE_NO),
    FOREIGN KEY (DOCID)
        REFERENCES JOURNAL_VOLUME (DOCID)
        ON DELETE CASCADE
);


INSERT INTO `JOURNAL_ISSUE` (`DOCID`,ISSUE_NO) VALUES
( 8,1),
( 9,2),
(10,3);

# GEDITS
DROP TABLE IF EXISTS GEDITS;
CREATE TABLE GEDITS (
    PID INT,
    DOCID INT,
    ISSUE_NO INT,
    PRIMARY KEY (DOCID , ISSUE_NO , PID),
    FOREIGN KEY (PID)
        REFERENCES PERSON (PID)
        ON DELETE CASCADE,
    FOREIGN KEY (DOCID , ISSUE_NO)
        REFERENCES JOURNAL_ISSUE (DOCID , ISSUE_NO)
        ON DELETE CASCADE
);

INSERT INTO `GEDITS` (`PID`, `DOCID`,ISSUE_NO) VALUES
(13, 8,1),
(14, 9,2),
(15,10,3);


# PROCEEDINGS
DROP TABLE IF EXISTS PROCEEDINGS;
CREATE TABLE PROCEEDINGS (
    DOCID INT PRIMARY KEY,
    CDATE DATE,
    CLOCATION VARCHAR(50),
    CEDITOR VARCHAR(50),
    FOREIGN KEY (DOCID)
        REFERENCES DOCUMENT (DOCID)
        ON DELETE CASCADE
);


INSERT INTO `PROCEEDINGS` (DOCID,CDATE,CLOCATION,CEDITOR) VALUES
(1,makedate(2020,3),'Harrison','john'),
(2,makedate(2020,4),'Jersey city','Mike'),
(8,makedate(2020,5),'Newark','Tyson'),
(9,makedate(2020,6),'Hoboken','Taylor'),
(10,makedate(2020,3),'Clifton','Mark');


# CHAIRS
DROP TABLE IF EXISTS CHAIRS;
CREATE TABLE CHAIRS (
    PID INT,
    DOCID INT,
    PRIMARY KEY (PID , DOCID),
    FOREIGN KEY (PID)
        REFERENCES PERSON (PID)
        ON DELETE CASCADE,
    FOREIGN KEY (DOCID)
        REFERENCES PROCEEDINGS (DOCID)
        ON DELETE CASCADE
);


INSERT INTO `CHAIRS` (`PID`, `DOCID`) VALUES
(1,1),
(2,2),
(8,8),
(9,9),
(10,10);
