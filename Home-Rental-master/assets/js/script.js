const body = document.querySelector("body"),
      modeToggle = body.querySelector(".mode-toggle");
      sidebar = body.querySelector("nav");
      sidebarToggle = body.querySelector(".sidebar-toggle");

      let getMode = localStorage.getItem("mode");
      if(getMode && getMode ==="dark"){
      body.classList.toggle("dark");
    }

        let getStatus = localStorage.getItem("status");
        if(getStatus && getStatus ==="close"){
          sidebar.classList.toggle("close");
         }

    modeToggle.addEventListener("click", () =>{
    body.classList.toggle("dark");
    if(body.classList.contains("dark")){
        localStorage.setItem("mode", "dark");
    }else{
        localStorage.setItem("mode", "light");
    }
    });