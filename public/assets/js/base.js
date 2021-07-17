const jsSidebarButton = document.querySelector("span.js-sidebar");
const jsSidebarTitles = ["Home", "Profile", "Settings", "Services"];

/** Open/Close Sidebar */
if (jsSidebarButton) {
	jsSidebarButton.addEventListener("click", function(event) {

		let parentHeader = jsSidebarButton.parentNode.parentNode.parentNode;
		let parentList 	 = jsSidebarButton.parentNode.parentNode;

		if (parentHeader.style.width === "7.5em") {
			parentHeader.style.width = "5em";
			for (let i = 1; i < parentList.childElementCount; i++) {
				let spanEl = parentList.children[i].querySelector("span.main-sidebar-title");
				parentList.children[i].children[0].removeChild(spanEl);
			}
		} else {
			parentHeader.style.width = "7.5em";
			for (let i = 1; i < parentList.childElementCount; i++) {
				let spanEl = document.createElement("SPAN");
				spanEl.innerHTML = jsSidebarTitles[i-1];
				spanEl.className = "main-sidebar-title";
				parentList.children[i].children[0].append(spanEl);
			}
		}

	});
}