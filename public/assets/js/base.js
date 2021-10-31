const jsSidebarButton = document.querySelector("span.js-sidebar");
const jsSidebarTitles = ["Home", "Profile", "Settings", "Services"];

/** Open/Close Sidebar */
if (jsSidebarButton) {
    jsSidebarButton.addEventListener("click", function(event) {

        let parentHeader = jsSidebarButton.parentNode.parentNode.parentNode;
        let parentList   = jsSidebarButton.parentNode.parentNode;

        if (parentHeader.style.width === "7.5em") {
            parentHeader.style.width = "5em";
            for (let i = 1; i < parentList.childElementCount; i++) {
                let spanEl = parentList.children[i].querySelector("span.main-sidebar-title");
                parentList.children[i].children[0].removeChild(spanEl);
            }
        } else {
            parentHeader.style.width = "7.5em";
            for (let i = 1; i < parentList.childElementCount; i++) {
                let spanEl = document.createElement("span");
                spanEl.innerHTML = jsSidebarTitles[i-1];
                spanEl.className = "main-sidebar-title";
                parentList.children[i].children[0].append(spanEl);
            }
        }

    });
}

/** Check for double ids and classes */
const ids = [];
document.body.querySelectorAll("*").forEach(el => {
    if (el.id) {
        let idArr = el.id.split(" ");
        idArr.forEach(id => ids.push(id));
    }
});

/** Class Loop Control */
for (let k = 0; k < ids.length; k++) {
    for (let n = 0; n < ids.length; n++) {
        if (n !== k && ids[k] === ids[n]) {
            console.error(`Double inner id stack: ${ids[k]}`);
        }
    }
}

