Users:
1. There will be one type of user, normal users, no admin users for this project.

Users can do the following things:
1. User can register an account.
2. A user can login.
3. Users can update their profile.
4. A User can change the password.
5. A user can upload a picture.
6. A user can create a photo album.
7. A user can create a headline and a thumbnail text and a description.
8. A user can comment on other pictures and galleries.
9. A user can edit and delete galleries and pictures.
10. A user can contact other users.

Databases:
The application will have the following databases:
- users table
- profile_pics table
- galleries table
- pictures table
- categories table
- comments table (pictures)

Users table
- id int(11)
- username varchar(255)
- email varchar(255)
- profile_pic varchar(255)
- user_description varchar(255)
- password
- created_at timestamp
- updated_at timestamp

Profile_pics table
- pic_id int(11)
- profile_pic varchar(255)
- tmp_name varchar(255)
- user_id int(11) foreign key

Galleries table
- gallery_id int(11)
- gallery_name varchar(255)
- gallery_description text ((should have 300 character limit))
- cat_id int(11) foreign key
- user_id int(11) foreign key

Pictures table
- picture_id int(11)
- picture varchar(255)
- title varchar(255)
- thumbnail_text varchar(255)
- picture_description text
- cat_id int(11) foreign key
- user_id int(11) foreign key
- gallery_id int(11) foreign key
- created_at timestamp
- updated_at timestamp

Categories table (will be created on the backend)
- category_id int(11)
- category_name varchar(255)

Comments_gallery table
- comment_id int(11)
- comment text
- gallery_id int(11) foreign key
- user_id int(11) foreign key
- created_at timestamp
- updated_at timestamp

Comments_picture table
- comment_id int(11)
- comment text
- picture_id int(11) foreign key
- user_id int(11) foreign key
- created_at timestamp
- updated_at timestamp

Pages
- index.php
- login.php
- register.php
- dashboard.php
- profile.php
- gallery.php
- galleries.php
- picture.php
- discover.php
- messages.php
- message.php
- contact.php
- about.php
- faq.php

Index.php
- Randomized header image - showcase section, search bar
- Randomized photos from different galleries

Dashboard.php
- See latest comments
- Create gallery button
- Edit your credentials

Profile
- Show stats, number of galleries, pictures
- Show how long they have been a member
- Show bio

Gallery.php
- Show number of pictures
- Show the creator
- Display photos
- Show picture thumbnail (when hover?)

Galleries.php
- Show number of galleries
- Show the creator
- Display galleries

picture.php
- Show title
- Show picture
- Show description
- Show comments

discover.php
- Popular collection
