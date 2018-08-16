SELECT * FROM user;
SELECT id FROM user WHERE 1;
SELECT * FROM user WHERE email='ernesto3d@illumant.com';
SELECT * FROM client;
SELECT name FROM project WHERE status='ACTIVE';
SELECT * from campaign_type;
SELECT * FROM campaign;

SELECT campaign.id as id,campaign.name as name,campaign.description as description,campaign_type.name as type,campaign.status as status,campaign.created as created,client.name as clientname,project.name as projectname
FROM campaign,campaign_type,client,project
WHERE campaign.campaign_type_id=campaign_type.id ORDER BY created DESC;

SELECT STR_TO_DATE('01,5,2013','%d,%m,%Y');

SELECT DATE_FORMAT(STR_TO_DATE('06/28/2017','%m/%d/%Y'),'%Y-%m-%d');



UPDATE project SET end_date=DATE_FORMAT(STR_TO_DATE('07/28/2017','%m/%d/%Y'),'%Y-%m-%d') WHERE id=13;


UPDATE user SET first_name='Mark',last_name='Snodgrass' WHERE id=1;

SELECT id,name,description,created_at,status FROM client WHERE status="ACTIVE";

SELECT id,name,start_date,end_date,status FROM project WHERE client_id=1;
SELECT id,name,DATE_FORMAT(start_date, "%M %d, %Y at %h:%i %p") as start_date,DATE_FORMAT(end_date, "%M %d, %Y at %h:%i %p") as end_date,status FROM project WHERE client_id=1;