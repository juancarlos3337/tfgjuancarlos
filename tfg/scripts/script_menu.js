 const header = document.getElementById("divHeader");
  //para cuando haga scroll, se ponga los estilos al header
    window.addEventListener("scroll", () => {
      if (window.scrollY > 50) {
        header.classList.remove("bg-transparent","text-white");
        header.classList.add("bg-[#5C3B1E]", "shadow-md","text-[#FFE08A]");
      } else {
        header.classList.add("bg-transparent","text-white");
        header.classList.remove("bg-[#5C3B1E]", "shadow-md", "text-black");
      }
    });

