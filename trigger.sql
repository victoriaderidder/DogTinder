DELIMITER $$
 CREATE TRIGGER `Before_Insert_Location` BEFORE INSERT ON `Visited`
 FOR EACH ROW BEGIN
  IF (EXISTS(SELECT 1 FROM Visited d WHERE d.Username = NEW.Username && d.Location_ID = New.Location_ID)) THEN
    SIGNAL SQLSTATE VALUE '45000' SET MESSAGE_TEXT = 'INSERT failed due to duplicate mobile number';
    END IF;
END;
$$
DELIMITER ;
