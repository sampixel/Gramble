let profileSection = document.querySelector("section.profile");

let xhr = new XMLHttpRequest;
xhr.onreadystatechange = function(event) {
    if (this.readyState === 4 && this.status === 200) {
        let res = this.response;
        for (let key in res) {
            profileSection.innerHTML += `${key}: ${res[key]}`;
        }
        console.log(res);
    }
}
xhr.responseType = "json";
xhr.open("get", "/jsonprofile", true);
xhr.send(null);