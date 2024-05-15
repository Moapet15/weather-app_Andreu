function requestSignin(event) {
    console.log("Sign-In in...")
    // event.preventDefault()
    let user = document.getElementById('inputUserSignin').value
    let password = document.getElementById('inputPasswordSignin').value
    const formData = new URLSearchParams();
    formData.append('user', user);
    formData.append('password', password);
    formData.append('login', true);
    console.log(user, ",", password)
    const options = {
        method: 'POST',
        body: formData
    };
    
    fetch("./sign-In.php", options)
        .then(response => response.text())
        .then(data => {
            if (data === "Sign-In Ok!") {
                console.log("Sign-In successful!");
            } else {
                console.log(data);
                console.log("Sign-In failed!");
            }
        })
        .catch(error => {
            console.error("Error during Sign-In:", error);
        });
}

function requestDropSigned(event) {
    console.log("Sign-Out in...")
    let user = document.getElementById('inputUserSignin').value;
    let password = document.getElementById('inputPasswordSignin').value;
    const formData = new URLSearchParams();
    formData.append('user', user);
    formData.append('password', password);
    formData.append('signedOut', true);
    console.log(user, ",", password);
    const options = {
        method: 'POST',
        body: formData
    };
    fetch("./sign-In.php", options)
        .then(response => response.text())
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error("Error during Drop-Signed:", error);
        });
}

export { requestSignin, requestDropSigned }