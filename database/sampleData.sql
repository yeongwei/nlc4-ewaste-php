-- ***********
-- ewaste_user
-- ***********

-- donor
insert into ewaste_user (isactive,age,gender,name,_role,email)
values (true, 20, 'male', 'Anand', 'donor', 'anand@persistent.com')

-- volunteer
insert into ewaste_user (isactive,company,_role,email,phone,address,city,postcode,state,latitude,longitude)
values (true, 'Persistent System Limited', 'volunteer', 'info@persistent.com', '+60 (03) 7663 8300' , '601 Level 6, Uptown 1, Jalan SS21/58, Damansara Uptown', 'Petaling Jaya', 47400, 'Selangor', '3.1366612' ,'101.6217609')

-- recycler
insert into ewaste_user (isactive,company,_role,email,phone,address,city,postcode,state,latitude,longitude)
values (true, 'MCMC', 'recycler', 'mobileewaste@cmc.gov.my ', '+603 8688 8000' , 'MCMC Tower 1, Jalan Impact, Cyber 6', 'Cyberjaya', 63000 , 'Selangor', '2.921653' ,'101.663423')


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