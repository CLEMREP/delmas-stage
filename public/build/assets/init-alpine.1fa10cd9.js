document.addEventListener("alpine:init",()=>{Alpine.data("data",()=>({isSideMenuOpen:!1,toggleSideMenu(){this.isSideMenuOpen=!this.isSideMenuOpen},closeSideMenu(){this.isSideMenuOpen=!1},isNotificationsMenuOpen:!1,toggleNotificationsMenu(){this.isNotificationsMenuOpen=!this.isNotificationsMenuOpen},closeNotificationsMenu(){this.isNotificationsMenuOpen=!1},isProfileMenuOpen:!1,toggleProfileMenu(){console.log("ici"),this.isProfileMenuOpen=!this.isProfileMenuOpen},closeProfileMenu(){console.log("la"),this.isProfileMenuOpen=!1},isPagesMenuOpen:!1,togglePagesMenu(){this.isPagesMenuOpen=!this.isPagesMenuOpen},isModalOpen:!1,trapCleanup:null,openModal(){this.isModalOpen=!0,this.trapCleanup=focusTrap(document.querySelector("#modal"))},closeModal(){this.isModalOpen=!1,this.trapCleanup()}}))});