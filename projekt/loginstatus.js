async function checkLoginStatus() {
    const response = await fetch('../check-login.php');
    const data = await response.json();

    if (data.isLoggedIn) {

        handleLogin();
    } else {

        handleLogout();
    }


    return data.isLoggedIn;
}

function handleLogin() {
    document.getElementById('loginButtonContainer').style.display = 'none';
    document.getElementById('loggedInMenu').style.display = 'block';
}

function handleLogout() {
    document.getElementById('loginButtonContainer').style.display = 'block';
    document.getElementById('loggedInMenu').style.display = 'none';
}

async function login0() {
    const isLoggedIn = await checkLoginStatus();

    if (!isLoggedIn) {
        window.location.href = "../login.php";
    }
}

window.onload = checkLoginStatus;