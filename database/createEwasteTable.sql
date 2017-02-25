create table ewaste_user
(
   _id int AUTO_INCREMENT,
   _index int,
   guid varchar(255),
   isactive boolean,
   age int,
   gender varchar(255),
   name varchar(255),
   company varchar(255),
   _role varchar(255),
   email varchar(255),
   phone varchar(255),
   address varchar(255),
   city varchar(255),
   postcode int,
   state varchar(255),
   registered timestamp,
   latitude varchar(255),
   longitude varchar(255),
   image_path varchar(255), 
   company_desc varchar(255)
   primary key(_id)
)

create table ewaste_trx
(
   _id int AUTO_INCREMENT, -- transaction
   donor_id int,
   volunteer_id int,
   recycler_id int, -- updated when recyler requested
   weight double,
   trx_date timestamp, 
   status varchar(255), --A: available, R: Requested , C: Collected
   primary key(_id) 
)

create table ewaste_promo
(
	_id int AUTO_INCREMENT,
	volunteer_id int, 
	promotion_text varchar(255), 
	start_date date,
	expiry_date date, 
	status boolean, -- active , inactive
	primary key(_id) 
)