-- ***********
-- ewaste_user
-- ***********

-- donor
insert into ewaste_user (isactive,age,gender,name,_role,email)
values (true, 20, 'male', 'Azlin', 'donor', 'azlin@persistent.com')

-- volunteer
insert into ewaste_user (isactive,company,_role,email,phone,address,city,postcode,state,latitude,longitude, image_path, company_desc)
values (true, 'Persistent System Limited', 'volunteer', 'info@persistent.com', '+60 (03) 7663 8300' , '601 Level 6, Uptown 1, Jalan SS21/58, Damansara Uptown', 'Petaling Jaya', 47400, 'Selangor', '3.1366612' ,'101.6217609',  './images/ewaste_user/persistent.jpg', 'Software Development House')

-- recycler
insert into ewaste_user (isactive,company,_role,email,phone,address,city,postcode,state,latitude,longitude, image_path, company_desc)
values (true, 'MCMC', 'recycler', 'mobileewaste@cmc.gov.my ', '+603 8688 8000' , 'MCMC Tower 1, Jalan Impact, Cyber 6', 'Cyberjaya', 63000 , 'Selangor', '2.921653' ,'101.663423', './images/ewaste_user/mcmc.png', 'Regulator')


-- ***********
-- ewaste_trx 
-- ***********
-- initial entry
insert into ewaste_trx (donor_id,volunteer_id,recycler_id,weight,trx_date,status)
values (1,8, null, 1.1, CURRENT_TIMESTAMP(), 'available' )



-- ***********
-- ewaste_promo
-- ***********
insert  into ewaste_promo (volunteer_id,promotion_text,start_date,expiry_date,status)
values (8, 'Join Semicolon for free' , '2017-01-01 00:00:00', '2017-03-01 00:00:00', true)


-- ***********
-- promo query
-- ***********

select promotion_text , usr.company, company_desc, image_path
from ewaste_promo promo, ewaste_user usr
where status = true and start_date < current_timestamp() and current_timestamp() <= expiry_date
and promo.volunteer_id = usr._id;

-- ****************
-- collector query
-- ****************

select usr.company, company_desc, image_path, sum_weight, sum_weight/50 * 100 as percent_full
from -- full is 50 kg
   (select volunteer_id, sum(weight) sum_weight from ewaste_trx 
    where status = 'available'
    group by volunteer_id) trx, ewaste_user usr
where trx.volunteer_id = usr._id;