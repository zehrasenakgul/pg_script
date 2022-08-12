window.onload = function(){
  var piemenu = new wheelnav('piemenu');
  piemenu.clockwise = false;
  piemenu.animatetime = 500;
  piemenu.animateeffect = 'linear';
  piemenu.wheelRadius = piemenu.wheelRadius * 1.3;
  if(screen.width < 600){
      piemenu.wheelRadius = piemenu.wheelRadius * 0.75;
  }
  piemenu.createWheel();
}
console.log("Başarılı")
var options = {
  Menu0: {
    1: ["Developers", "System Engineers", "IT Architectures", "Business Analyst","Project Manager","Product Owner","Test Engineer","Designer","Digital Marketing Professionals","Art Directors","Growth Manager","People and Culture Manager","Devops Engineer","Marketing Professionals","Sales and Channel Professionals","ERP and CRM Consultants","C level Professionals","Others"],
    2: ["Bu", "Da", "Başka", "Biri"],
    3: ["1", "3", "5", "7"],
    4: ["x", "xx", "xxx", "xxxx"],
  },
  Menu1: {
    1: ["Aggrements"],
    2: ["Regulatory Compliance"],
    3: ["Dispute Resolution"],
  },
  Menu2: {
    1: ["", "", ""],
    2: ["UK", "Belarus", "Turkey"],
    3: ["1", "3", "5", "7"],
    4: ["Belarus", "Turkey", "xxx", "xxxx"],
    5: ["UK"],
    6 : ["..."],
    7 : ["UK","Belarus","Turkey"]
  },
  Menu3: {
    1: ["Single - Page Application", "Multiple -Page Application", "Multipurpose Application", "Content Management System","Landing Page","E-commerce Application","Web3 Application","Others"],
    2: ["Mobile Games", "Social Media", "Productivity", "E-commerce","Education","Others"],
    3: ["1", "3", "5", "7"],
    4: ["x", "xx", "xxx", "xxxx"],
    5 : ["Penetration Test","Red Team"],
    6 : ["AI","Analytics","Business Intelligence"],
    7 : ["Strategy and Architecture","Engineering Craftsmanship","Growing and Leading the Team","Technology Due Diligence","Advisory and Coaching"]
  },
  Menu4: {
    1: ["Migrate your application to Cloud", "Migrate your e-mail to Cloud", "Others"],
    2: ["Cost Optimization", "Performance Optimization", "Security Optimization", "Re-Architecture","Others"],
    3: ["Cloud Devops / Deployment Lifecycle Management", "Kubernetes,Docker Management", "Infrsatructure", "Others"],
  },
  Menu5: {
    1: ["SEO Consulting", "ASO", "User Experience Optimization", "Traffic Data Analysis"],
    2: ["...", "Da", "Başka", "Biri"],
    3: ["Google Ads", "Yandex Ads", "Email Marketing", "Social Marketing","Conversion Rate Optimization"],
    4: ["SwipeLine", "...", "xxx", "xxxx"],
  },
  Menu6: {
    1: ["Berkay", "Buhlar", "Başardı", "mı"],
    2: ["Bu", "Da", "Başka", "Biri"],
    3: ["1", "3", "5", "7"],
    4: ["x", "xx", "xxx", "xxxx"],
  },
};
var Menu0 = {
  1: "Recruitment",
  2: "Add your CV",
};
var infos0 = {
  1: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
  2: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
};
var Menu1 = {
  1: "Agreements",
  2: "Regulatory Compliance",
  3: "Dispute Resolution",
};
var infos1 = {
  1: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
  2: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
  3: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
};
var Menu2 = {
  1: "Manufacturing",
  2: "Retail",
  3: "Healthcare",
  4: "Finance",
  5: "E-Commerce",
  6: "CyberSecurity",
  7: "Omnichannel"
};
var infos2 = {
  1: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
  2: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
  3: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
  4: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
  5: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
  6: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
  7: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
};
var Menu3 = {
  1: "Web Development",
  2: "Mobile Development",
  3: "ERP",
  4: "CRM",
  5: "Security",
  6: "Data",
  7: "CTO as a Service"
};
var infos3 = {
  1: " We develop your applications using PHP, Node.JS, Python, .net, C, C++, Javascript, Go and more ",
  2: " We develop native or hybrid applications using Swift, react native, flutter, ruby and more ",
  3: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
  4: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
  5: ""
};
var Menu4 = {
  1: "Migration",
  2: "Optimization",
  3: "Operations & Platform Services",
};
var infos4 = {
  1: "Redeploy your workloads to get best performance ",
  2: "Provide re-architect or refactor to provide cost optimization",
  3: "iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
};
var Menu5 = {
   1: "SEO",
   2 : "Content Management", 
   3: "Ads", 
   4: "Influencer Marketing"
};
var infos5 = {
  1: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
  2: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
  3: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
  4: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
};
var Menu6 = {
  1: "Finnancial Reporting",
  2: "Valuation of Company",
  3: "Due Diligence Preparation",
  4: "Tax Oriented Services",
  5: "Accounting Services",
  6 : "Goverment Grants,Credits and Incentives"
};
var infos6 = {
  1: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
  2: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
  3: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
  4: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
  3: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
  4: " iste at nostrum quis vero architecto? Obcaecati nemo impedit tempora neque eaque ipsa, tempore quidem laudantium deserunt suscipit debitis perferendis ullam at magnam quasi provident ab mollitia hic aliquid.",
};
var dropdown_Infos = {
  Menu0: {
    1: [
      "HR Infosu Burada",
      "HR2 Infosu Burada",
      "HR3 Infosu Burada",
      "HR4 Infosu Burada",
    ],
    2: [
      "22Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
    ],
    3: [
      "33Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
    ],
    4: [
      "44Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
    ],
  },
  Menu1: {
    1: [
      "Legal1 Infosu Burada",
      "Legal2 Infosu Burada",
      "Legal3 Infosu Burada",
      "Legal4 Infosu Burada",
    ],
    2: [
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
    ],
    3: [
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
    ],
    4: [
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
    ],
  },
  Menu2: {
    1: [
      "Sales1 Infosu Burada",
      "Sales2 Infosu Burada",
      "Sales3 Infosu Burada",
      "Sales4 Infosu Burada",
    ],
    2: [
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
    ],
    3: [
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
    ],
    4: [
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
    ],
    5: [
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
    ],
    6: [
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
    ],
    7: [
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
    ],
  },
  Menu3: {
    1: [
      "Laravel Infosu Burada",
      "Django Infosu Burada",
      "Flask Infosu Burada",
      "PHP Infosu Burada",
    ],
    2: [
      "Flutter Infosu Burada",
      "React Native Info",
      "Swift Info",
      "Kotlin Info",
    ],
    3: [
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
    ],
    4: [
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
    ],
    5: [
      "According to scope, team scan your systems in detail based on OWASP standarts and all breachs are reported to you. This service is not a process. Applied for once time. ",
      "It is target oriented process towards threat simulation. It is ongoing process and looking for security breach and reported to you. ",
      "Placeholder Info",
      "Placeholder Info",
    ],
    6: [
      "Artificial Intelligence Platforms enable machines to be used to perform tasks completed by humans.You can reach out image recognition services",
      "Considered a relatively new field that combines cutting-edge computing and statistical techniques to extract business value from a rapidly expanding volume of data. ",
      "Business intelligence gives organizations the ability to ask questions in plain language and get answers they can understand. It combines business analytics, data mining, data visualization and data infrastructure to help organizations make more data-driven decisions. ",
      "Placeholder Info",
    ],
    7: [
      "We use our collective experience to define the foundations in the right way - from the product roadmap and architecture to the technology stack and team composition - we've got your back",
      "When technology becomes a bottleneck from the scalability, security or further product evolution perspective, we can help to redesign the existing solution and get back on track ",
      "We set the bar high when it comes to technology leadership. The quality of your engineering team, processes and culture will shape the outcomes for the whole business",
      "Our experts will analyze the opportunities and risks based on business alignment, strategy, architecture, people and processes, innovation potential, scalability and security",
      "We offer CTO advisory or second opinion on the matters of architecture, strategy, organization and processes. Our advisors can empower your permanent CTO with their vision of the future and innovation."
    ]
  },
  Menu4: {
    1: [
      "Get service to migrate Applications, Database Services, Web Services, Infrastructures",
      "Get service to migrate e-mail, workplaces, communication systems, file serve",
      "others",
    ],
    2: [
      "Optimize your workloads on cloud & infrastructure and minimize your costs",
      "Tune your workloads to improve for best performance",
      "Improve your cloud security across your organization, planning, desinging, configuration, maintenance, testing and remediation",
      "Re-architect workloads, provide operation excellence ",
      "others"
    ],
    3: [
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
    ],
    4: [
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
    ],
  },
  Menu5: {
    1: [
      "Marketing1 Infosu Burada",
      "Marketing2 Infosu Burada",
      "Marketing3 Infosu Burada",
      "Marketing4 Infosu Burada",
    ],
    2: [
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
    ],
    3: [
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
    ],
    4: [
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
    ],
  },
  Menu6: {
    1: [
      "Finance1 Infosu Burada",
      "Finance2 Infosu Burada",
      "Finance3 Infosu Burada",
      "Finance4 Infosu Burada",
    ],
    2: [
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
    ],
    3: [
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
    ],
    4: [
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
      "Placeholder Info",
    ],
  },
};
var piemenuInfos = {
  0: "Technology departments have become very critical for companies. Since it is a very different field from the normal staff selection criteria, selecting technology-oriented employees requires  a separate expertise. We conduct HR and Technical interviews with our candidates, and then share the most suitable candidates with our customers. In this entire process, we give great importance to the confidentiality of our client and candidate processes and open communication. ",
  1: "Startups need to handle a lot of legal issues. We categorize them in three groups as <br> (i) agreements, <br> (ii) regulatory compliance, and <br> (iii) dispute resolution. Write short description of your legal need and select partner's available time to meet online. ",
  2: "Scale your business via channel partners and meet as online ",
  3: "We're building softwares to speed up workflows. We can develop a core or main software architecture to create a web app and mobile app that are one technology. This can be either with two or more user models, or we can build more than one dynamic structure on one app. At the same time, we can develop, add additional models, or bug-fix operations through existing scripts or software.",
  4: "We know that SLA, secure back-end, scalability and price optimization are important to create sustainability on your business. Write short description and select partner's available time and meet as online. ",
  5: "Critical step to create awareness about your brand. Write short description and select partner's available time and meet as online. ",
  6: "Keep your balance exclusively",
};
var piemenuHeaders = {
  0: "Human Resources",
  1: "Legal",
  2: "Sales & Channels",
  3: "Software Development",
  4: "Cloud",
  5: "Marketing",
  6: "Finance",
};

let choosenFilterOptions = document.querySelector(".activatedFilterParameters");
function deleteActiveFilter(deleteValue) {
  let to_beDeleted = document.querySelector(`#activeFilterCont_${deleteValue}`);
  to_beDeleted.parentNode.removeChild(to_beDeleted);
}
function showSelection(paramNum) {
  let chosenSelection = document.querySelector(`#Parameter${paramNum}`);
  let ChoosenOption =
    chosenSelection.options[chosenSelection.selectedIndex].value;
  if (ChoosenOption !== "filterNoValue") {
    let filter_tag = document.createElement("span");
    let filter_delete_btn = document.createElement("button");
    filter_delete_btn.type = "button";
    filter_delete_btn.innerHTML = '<i class="fa-solid fa-xmark"></i>';
    let filter_tag_container = document.createElement("div");
    filter_tag_container.className = "d-flex align-items-center gap-2";
    filter_tag_container.id = `activeFilterCont_${ChoosenOption}`;
    filter_delete_btn.id = `filterDeletebtn_${ChoosenOption}`;
    filter_delete_btn.className = "filterDeletebtn";
    filter_delete_btn.setAttribute(
      "onclick",
      `deleteActiveFilter('${ChoosenOption}')`
    );
    filter_tag.innerText = ChoosenOption;
    filter_tag_container.appendChild(filter_tag);
    filter_tag_container.appendChild(filter_delete_btn);
    choosenFilterOptions.appendChild(filter_tag_container);
  }
}

let headercont = document.querySelector(".infoContainer_Header");
let infoPcont = document.querySelector(".infoContainer_Paragraph");
let linkMenu = document.querySelector(".linkMenu");
let infoMenu = document.querySelector(".infoMenu");
function openTheMenu(menuNumber) {
  info_cont.style.display = "block";
  headercont.innerHTML = "";
  infoPcont.innerHTML = "";
  linkMenu.innerHTML = "";
  infoMenu.innerHTML = "";
  if (menuNumber == 0) {
    slice_header = document.createElement("span");
    slice_header.className = "giveninfo_Title titleActive";
    slice_header.innerText = piemenuHeaders[0];
    slice_info = document.createElement("p");
    slice_info.className = "giveninfo_Paragraph infopActive";
    slice_info.innerText = piemenuInfos[0];
    for (link in Menu0) {
      let infobtn = document.createElement("div");
      // infobtn.className = "list-group-item";
      // infobtn.innerHTML = '<img src="./images/arrowOption.svg" alt="">';
      infoMenu.appendChild(infobtn);
      let new_link = document.createElement("a");
      new_link.setAttribute("onmouseup", `showInfo(${link})`);
      new_link.className = "list-group-item";
      new_link.setAttribute("onclick", `showForm(${link})`);
      new_link.innerText = Menu0[link];
      linkMenu.appendChild(new_link);
      new_info_header = document.createElement("span");
      new_info_header.className = "giveninfo_Title";
      new_info_header.id = `infoHeader${link}`;
      new_info_header.innerText = Menu0[link];
      headercont.appendChild(new_info_header);
      new_info_p = document.createElement("p");
      new_info_p.innerText = infos0[link];
      new_info_p.id = `infoP${link}`;
      new_info_p.className = "giveninfo_Paragraph";
      infoPcont.appendChild(new_info_p);
    }
    headercont.appendChild(slice_header);
    infoPcont.appendChild(slice_info);
  }
  if (menuNumber == 1) {
    slice_header = document.createElement("span");
    slice_header.className = "giveninfo_Title titleActive";
    slice_header.innerText = piemenuHeaders[1];
    slice_info = document.createElement("p");
    slice_info.className = "giveninfo_Paragraph infopActive";
    slice_info.innerText = piemenuInfos[1];
    headercont.appendChild(slice_header);
    infoPcont.appendChild(slice_info);
    for (link in Menu1) {
      let infobtn = document.createElement("div");
      // infobtn.className = "list-group-item";
      // infobtn.innerHTML = '<img src="./images/arrowOption.svg" alt="">';
      infobtn.setAttribute("onclick", `showInfo(${link})`);
      infoMenu.appendChild(infobtn);
      let new_link = document.createElement("a");
      new_link.setAttribute("onmouseup", `showInfo(${link})`);
      new_link.className = "list-group-item";
      new_link.setAttribute("onclick", `showForm(${link})`);
      new_link.innerText = Menu1[link];
      linkMenu.appendChild(new_link);
      new_info_header = document.createElement("span");
      new_info_header.className = "giveninfo_Title";
      new_info_header.id = `infoHeader${link}`;
      new_info_header.innerText = Menu1[link];
      headercont.appendChild(new_info_header);
      new_info_p = document.createElement("p");
      new_info_p.innerText = infos1[link];
      new_info_p.id = `infoP${link}`;
      new_info_p.className = "giveninfo_Paragraph";
      infoPcont.appendChild(new_info_p);
    }
  }
  if (menuNumber == 2) {
    slice_header = document.createElement("span");
    slice_header.className = "giveninfo_Title titleActive";
    slice_header.innerText = piemenuHeaders[2];
    slice_info = document.createElement("p");
    slice_info.className = "giveninfo_Paragraph infopActive";
    slice_info.innerHTML = piemenuInfos[2];
    headercont.appendChild(slice_header);
    infoPcont.appendChild(slice_info);
    for (link in Menu2) {
      let infobtn = document.createElement("div");
      // infobtn.className = "list-group-item";
      // infobtn.innerHTML = '<img src="./images/arrowOption.svg" alt="">';
      infobtn.setAttribute("onclick", `showInfo(${link})`);
      infoMenu.appendChild(infobtn);
      let new_link = document.createElement("a");
      new_link.setAttribute("onmouseup", `showInfo(${link})`);
      new_link.className = "list-group-item";
      new_link.setAttribute("onclick", `showForm(${link})`);
      new_link.innerText = Menu2[link];
      linkMenu.appendChild(new_link);
      new_info_header = document.createElement("span");
      new_info_header.className = "giveninfo_Title";
      new_info_header.id = `infoHeader${link}`;
      new_info_header.innerText = Menu2[link];
      headercont.appendChild(new_info_header);
      new_info_p = document.createElement("p");
      new_info_p.innerText = infos2[link];
      new_info_p.id = `infoP${link}`;
      new_info_p.className = "giveninfo_Paragraph";
      infoPcont.appendChild(new_info_p);
    }
  }
  if (menuNumber == 3) {
    slice_header = document.createElement("span");
    slice_header.className = "giveninfo_Title titleActive";
    slice_header.innerText = piemenuHeaders[3];
    slice_info = document.createElement("p");
    slice_info.className = "giveninfo_Paragraph infopActive";
    slice_info.innerText = piemenuInfos[3];
    headercont.appendChild(slice_header);
    infoPcont.appendChild(slice_info);
    for (link in Menu3) {
      let infobtn = document.createElement("div");
      // infobtn.className = "list-group-item";
      // infobtn.innerHTML = '<img src="./images/arrowOption.svg" alt="">';
      infobtn.setAttribute("onclick", `showInfo(${link})`);
      infoMenu.appendChild(infobtn);
      let new_link = document.createElement("a");
      new_link.setAttribute("onmouseup", `showInfo(${link})`);
      new_link.className = "list-group-item";
      new_link.innerText = Menu3[link];
      new_link.setAttribute("onclick", `showForm(${link})`);
      linkMenu.appendChild(new_link);
      new_info_header = document.createElement("span");
      new_info_header.className = "giveninfo_Title";
      new_info_header.id = `infoHeader${link}`;
      new_info_header.innerText = Menu3[link];
      headercont.appendChild(new_info_header);
      new_info_p = document.createElement("p");
      new_info_p.innerText = infos3[link];
      new_info_p.id = `infoP${link}`;
      new_info_p.className = "giveninfo_Paragraph";
      infoPcont.appendChild(new_info_p);
    }
  }
  if (menuNumber == 4) {
    slice_header = document.createElement("span");
    slice_header.className = "giveninfo_Title titleActive";
    slice_header.innerText = piemenuHeaders[4];
    slice_info = document.createElement("p");
    slice_info.className = "giveninfo_Paragraph infopActive";
    slice_info.innerText = piemenuInfos[4];
    headercont.appendChild(slice_header);
    infoPcont.appendChild(slice_info);
    for (link in Menu4) {
      let infobtn = document.createElement("div");
      // infobtn.className = "list-group-item";
      // infobtn.innerHTML = '<img src="./images/arrowOption.svg" alt="">';
      infobtn.setAttribute("onclick", `showInfo(${link})`);
      infoMenu.appendChild(infobtn);
      let new_link = document.createElement("a");
      new_link.setAttribute("onmouseup", `showInfo(${link})`);
      new_link.className = "list-group-item";
      new_link.innerText = Menu4[link];
      new_link.setAttribute("onclick", `showForm(${link})`);
      linkMenu.appendChild(new_link);
      new_info_header = document.createElement("span");
      new_info_header.className = "giveninfo_Title";
      new_info_header.id = `infoHeader${link}`;
      new_info_header.innerText = Menu4[link];
      headercont.appendChild(new_info_header);
      new_info_p = document.createElement("p");
      new_info_p.innerText = infos4[link];
      new_info_p.id = `infoP${link}`;
      new_info_p.className = "giveninfo_Paragraph";
      infoPcont.appendChild(new_info_p);
    }
  }
  if (menuNumber == 5) {
    slice_header = document.createElement("span");
    slice_header.className = "giveninfo_Title titleActive";
    slice_header.innerText = piemenuHeaders[5];
    slice_info = document.createElement("p");
    slice_info.className = "giveninfo_Paragraph infopActive";
    slice_info.innerText = piemenuInfos[5];
    headercont.appendChild(slice_header);
    infoPcont.appendChild(slice_info);
    for (link in Menu5) {
      let infobtn = document.createElement("div");
      // infobtn.className = "list-group-item";
      // infobtn.innerHTML = '<img src="./images/arrowOption.svg" alt="">';
      infobtn.setAttribute("onclick", `showInfo(${link})`);
      infoMenu.appendChild(infobtn);
      let new_link = document.createElement("a");
      new_link.setAttribute("onmouseup", `showInfo(${link})`);
      new_link.className = "list-group-item";
      new_link.setAttribute("onclick", `showForm(${link})`);
      new_link.innerText = Menu5[link];
      linkMenu.appendChild(new_link);
      new_info_header = document.createElement("span");
      new_info_header.className = "giveninfo_Title";
      new_info_header.id = `infoHeader${link}`;
      new_info_header.innerText = Menu5[link];
      headercont.appendChild(new_info_header);
      new_info_p = document.createElement("p");
      new_info_p.innerText = infos5[link];
      new_info_p.id = `infoP${link}`;
      new_info_p.className = "giveninfo_Paragraph";
      infoPcont.appendChild(new_info_p);
    }
  }
  if (menuNumber == 6) {
    slice_header = document.createElement("span");
    slice_header.className = "giveninfo_Title titleActive";
    slice_header.innerText = piemenuHeaders[6];
    slice_info = document.createElement("p");
    slice_info.className = "giveninfo_Paragraph infopActive";
    slice_info.innerText = piemenuInfos[6];
    headercont.appendChild(slice_header);
    infoPcont.appendChild(slice_info);
    for (link in Menu6) {
      let infobtn = document.createElement("div");
      // infobtn.className = "list-group-item";
      // infobtn.innerHTML = '<img src="./images/arrowOption.svg" alt="">';
      infobtn.setAttribute("onclick", `showInfo(${link})`);
      infoMenu.appendChild(infobtn);
      let new_link = document.createElement("a");
      new_link.setAttribute("onmouseup", `showInfo(${link})`);
      new_link.className = "list-group-item";
      new_link.setAttribute("onclick", `showForm(${link})`);
      new_link.innerText = Menu6[link];
      linkMenu.appendChild(new_link);
      new_info_header = document.createElement("span");
      new_info_header.className = "giveninfo_Title";
      new_info_header.id = `infoHeader${link}`;
      new_info_header.innerText = Menu6[link];
      headercont.appendChild(new_info_header);
      new_info_p = document.createElement("p");
      new_info_p.innerText = infos6[link];
      new_info_p.id = `infoP${link}`;
      new_info_p.className = "giveninfo_Paragraph";
      infoPcont.appendChild(new_info_p);
    }
  }
  currentMenuNUM = menuNumber;
}

let currentMenuNUM = 0;
let is_myFormOpen = false;
let myform = document.querySelector("#myForm");
let optionInfo_Container = document.querySelector(".optionInfo_Container");
let options_cont = document.querySelector("#somethingSelection");
function showForm(formNum) {
  options_cont.innerHTML = " <option selected>Open this select menu</option>";
  optionInfo_Container.innerHTML = "";
  if (currentMenuNUM == 0) {
    for (filter in options.Menu0[formNum]) {
      filter_element = document.createElement("option");
      filter_element.value = options.Menu0[formNum][filter];
      filter_element.innerText = options.Menu0[formNum][filter];
      optionInfo = document.createElement("span");
      optionInfo.id = `optionInfo${parseInt(filter) + 1}`;
      optionInfo.className = "optionInfo";
      optionInfo.innerText = dropdown_Infos.Menu0[formNum][filter];
      optionInfo_Container.appendChild(optionInfo);
      options_cont.appendChild(filter_element);
    }
  }
  if (currentMenuNUM == 1) {
    for (filter in options.Menu1[formNum]) {
      filter_element = document.createElement("option");
      filter_element.value = options.Menu1[formNum][filter];
      filter_element.innerText = options.Menu1[formNum][filter];
      optionInfo = document.createElement("span");
      optionInfo.id = `optionInfo${parseInt(filter) + 1}`;
      optionInfo.className = "optionInfo";
      optionInfo.innerText = dropdown_Infos.Menu1[formNum][filter];
      optionInfo_Container.appendChild(optionInfo);
      options_cont.appendChild(filter_element);
    }
  }
  if (currentMenuNUM == 2) {
    for (filter in options.Menu2[formNum]) {
      filter_element = document.createElement("option");
      filter_element.value = options.Menu2[formNum][filter];
      filter_element.innerText = options.Menu2[formNum][filter];
      optionInfo = document.createElement("span");
      optionInfo.id = `optionInfo${parseInt(filter) + 1}`;
      optionInfo.className = "optionInfo";
      optionInfo.innerText = dropdown_Infos.Menu2[formNum][filter];
      optionInfo_Container.appendChild(optionInfo);
      options_cont.appendChild(filter_element);
    }
  }
  if (currentMenuNUM == 3) {
    for (filter in options.Menu3[formNum]) {
      filter_element = document.createElement("option");
      filter_element.value = options.Menu3[formNum][filter];
      filter_element.innerText = options.Menu3[formNum][filter];
      optionInfo = document.createElement("span");
      optionInfo.id = `optionInfo${parseInt(filter) + 1}`;
      optionInfo.className = "optionInfo";
      optionInfo.innerText = dropdown_Infos.Menu3[formNum][filter];
      optionInfo_Container.appendChild(optionInfo);
      options_cont.appendChild(filter_element);
    }
  }
  if (currentMenuNUM == 4) {
    for (filter in options.Menu4[formNum]) {
      filter_element = document.createElement("option");
      filter_element.value = options.Menu4[formNum][filter];
      filter_element.innerText = options.Menu4[formNum][filter];
      optionInfo = document.createElement("span");
      optionInfo.id = `optionInfo${parseInt(filter) + 1}`;
      optionInfo.className = "optionInfo";
      optionInfo.innerText = dropdown_Infos.Menu4[formNum][filter];
      optionInfo_Container.appendChild(optionInfo);
      options_cont.appendChild(filter_element);
    }
  }
  if (currentMenuNUM == 5) {
    for (filter in options.Menu5[formNum]) {
      filter_element = document.createElement("option");
      filter_element.value = options.Menu5[formNum][filter];
      filter_element.innerText = options.Menu5[formNum][filter];
      optionInfo = document.createElement("span");
      optionInfo.id = `optionInfo${parseInt(filter) + 1}`;
      optionInfo.className = "optionInfo";
      optionInfo.innerText = dropdown_Infos.Menu5[formNum][filter];
      optionInfo_Container.appendChild(optionInfo);
      options_cont.appendChild(filter_element);
    }
  }
  if (currentMenuNUM == 6) {
    for (filter in options.Menu6[formNum]) {
      filter_element = document.createElement("option");
      filter_element.value = options.Menu6[formNum][filter];
      filter_element.innerText = options.Menu6[formNum][filter];
      optionInfo = document.createElement("span");
      optionInfo.id = `optionInfo${parseInt(filter) + 1}`;
      optionInfo.className = "optionInfo";
      optionInfo.innerText = dropdown_Infos.Menu6[formNum][filter];
      optionInfo_Container.appendChild(optionInfo);
      options_cont.appendChild(filter_element);
    }
  }
  if (is_myFormOpen == false) {
    myform.classList.toggle("showmyfrom");
    is_myFormOpen = !is_myFormOpen;
  }
  // myform.scrollIntoView(false);
}

// options_cont.addEventListener("change", () => {
//   let allOptions = document.getElementsByClassName("optionInfo");
//   for (option in allOptions) {
//     allOptions[option].className = "optionInfo";
//   }
//   let pickedOption = document.querySelector(
//     `#optionInfo${options_cont.selectedIndex}`
//   );
//   pickedOption.classList.toggle("optioninfoActive");
// });

let headers = document.getElementsByClassName("giveninfo_Title");
let titles = document.getElementsByClassName("giveninfo_Paragraph");
let info_cont = document.querySelector(".infoContainer");
function showInfo(element_num) {
  info_cont.style.display = "block";
  for (i = 0; i < headers.length; i++) {
    headers[i].classList.remove("titleActive");
    titles[i].classList.remove("infopActive");
  }
  let header = document.querySelector(`#infoHeader${element_num}`);
  let paragraph = document.querySelector(`#infoP${element_num}`);
  header.classList.toggle("titleActive");
  paragraph.classList.toggle("infopActive");
}
