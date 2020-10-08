const btnProfileUpdate = document.getElementById('btn_profile_update');
// const center = document.querySelector('.section_json');

let json_url = 'http://localhost/phpsandbox/php-con-to-pro/image_app/app.json?='+ new Date();

let request = new XMLHttpRequest();
request.open('GET', json_url);

request.responseType = 'json';
request.send();

// btnProfileUpdate.addEventListener('click', function(){
//     window.location = 'http://localhost/phpsandbox/php-con-to-pro/image_app/users/edit_profile.php?id='+getId();
// })


// request.onload = function(){
//     const users = request.response;
//     displayUser(users);
// };

function getId(jsonObj)
{
    const uid = jsonObj[0]['id'];
    return uid;
}

// function displayUser(jsonObj)
// {
//     const para = document.createElement('p');
//     para.textContent = jsonObj[0]['id'];
//     center.appendChild(para);
// }

