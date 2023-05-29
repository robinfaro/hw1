create database PYW;

use PYW;

create table UTENTI 
(
	id integer auto_increment primary key,
	nome varchar(255),
    cognome varchar(255),
    email varchar(255),
    username varchar(255),
    picture varchar(1024),
    psw varchar(255)
    

);


create table likes
(
	id integer auto_increment primary key,
	mail varchar(255),
    url varchar(511),
    title varchar(255)
);


create table totalLikes
(
	url varchar(511) primary key,
    total_likes integer
);


DELIMITER //
CREATE TRIGGER updateTotalLikes AFTER INSERT ON likes
FOR EACH ROW
BEGIN
    DECLARE likes_count INT;
    
    -- Verifica se esiste già un record per l'immagine nella tabella totalLikes
    SELECT total_likes INTO likes_count FROM totalLikes WHERE url = NEW.url;
    
    IF likes_count IS NULL THEN
        -- Se non esiste un record, inserisci un nuovo record con il conteggio dei like a 1
        INSERT INTO totalLikes (url, total_likes) VALUES (NEW.url, 1);
    ELSE
        -- Altrimenti, aggiorna il conteggio dei like per l'immagine esistente
        UPDATE totalLikes SET total_likes = total_likes + 1 WHERE url = NEW.url;
    END IF;
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER decrease_total_likes AFTER DELETE ON likes
FOR EACH ROW
BEGIN
    UPDATE totalLikes
    SET total_likes = total_likes - 1
    WHERE url = OLD.url;
END //
DELIMITER ; 





