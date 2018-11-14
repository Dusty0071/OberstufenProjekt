<?php
function wirteHead() {
    echo '<!DOCTYPE html>
    <!-- jsn_epic_pro 6.0.9 -->
    <html lang="de-de" dir="ltr">
      <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="GSO, GSO Köln, GSO Koeln, Georg Simon Ohm, Georg-Simon-Ohm-Berufskolleg, Georg-Simon-Ohm-Berufsschule, Medienschule, Medienberufsschule, Köln, Fachinformatiker, Mediengestalter Bild- und Ton, Informatik, Medientechnik, Fachschule, Fachschule für Technische Informatik, Technikerfachschule, BK13, Informationstechnische Assistenten, ITAs, Berufsfachschule, Berufskolleg, Medienberufskolleg, Medientechnik, Mediengestaltung, Abendschule, Meisterbafög, Erwachsenenweiterbildung, berufliche Weiterbildung, Informatik, Informatiker, staatliche geprüfter Informatiker, Techniker Fachrichtung Informatik Schwerpunkt technische Informatik, Computertechnik, Vollzeit, Teilzeit, Abendschule, abgeschlossene Ausbildung, berufliche Weiterbildung, ohne Gebühren, kostenlos, Alternative zum Studium, Fachhochschulreife, FH-Reife, FHR, AHR, Allgemeine Hochschulreife, Förderung, " />
        <meta name="description" content="Das Georg-Simon-Ohm-Berufskolleg ist das Kölner Berufskolleg für die Bereiche Informations- und Kommunikationstechnik, Medientechnik und Mediengestaltung." />
        <title>Protokoll-Tool</title>
        <link href="img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
        <link rel="stylesheet" href="css/template.css"/>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="css/bootstrap-res.css"/>
        <link rel="stylesheet" href="css/general.css"/>
        <link rel="stylesheet" href="css/system.css"/>
        <link rel="stylesheet" href="css/blue.css"/>
        <link rel="stylesheet" href="css/template_pro.css"/>
        <link rel="stylesheet" href="css/custom.css"/>
        <link rel="stylesheet" href="css/wide.css"/>
        <style type="text/css">
          div.jsn-modulecontainer ul.menu-mainmenu ul,
          div.jsn-modulecontainer ul.menu-mainmenu ul li {
          width: 210px;
          }
          div.jsn-modulecontainer ul.menu-mainmenu ul ul {
          margin-left: 209px;
          }
          #jsn-pos-toolbar div.jsn-modulecontainer ul.menu-mainmenu ul ul {
          margin-right: 209px;
          margin-left : auto
          }
          div.jsn-modulecontainer ul.menu-sidemenu ul,
          div.jsn-modulecontainer ul.menu-sidemenu ul li {
          width: 210px;
          }
          div.jsn-modulecontainer ul.menu-sidemenu li ul {
          right: -210px;
          }
          body.jsn-direction-rtl div.jsn-modulecontainer ul.menu-sidemenu li ul {
          left: -210px;
          right: auto;
          }
          div.jsn-modulecontainer ul.menu-sidemenu ul ul {
          margin-left: 209px;
          }
          #goog-gt-tt {display:none !important;}
          .goog-te-banner-frame {display:none !important;}
          .goog-te-menu-value:hover {text-decoration:none !important;}
          body {top:0 !important;}
          #google_translate_element2 {display:none!important;}
          a.flag {font-size:16px;padding:1px 0;background-repeat:no-repeat;background-image:url("img/16a.png");}
          a.flag:hover {background-image:url("img/16.png");}
          a.flag img {border:0;}
          a.alt_flag {font-size:16px;padding:1px 0;background-repeat:no-repeat;background-image:url("img/alt_flagsa.png");}
          a.alt_flag:hover {background-image:url("img/alt_flags.png");}
          a.alt_flag img {border:0;}
        </style>
          <script src="http://www.gso-koeln.de/media/system/js/mootools-core.js" type="text/javascript"></script>
          <script src="http://www.gso-koeln.de/media/system/js/core.js" type="text/javascript"></script>
          <script src="http://www.gso-koeln.de/media/system/js/caption.js" type="text/javascript"></script>
          <script src="http://www.gso-koeln.de/media/system/js/mootools-more.js" type="text/javascript"></script>
          <script src="http://www.gso-koeln.de/components/com_imageshow/assets/js/swfobject.js" type="text/javascript"></script>
          <script src="http://www.gso-koeln.de/components/com_imageshow/assets/js/jsn_is_extultils.js" type="text/javascript"></script>
          <script src="http://www.gso-koeln.de/components/com_imageshow/assets/js/jsn_is_imageshow.js" type="text/javascript"></script>
          <script src="http://www.gso-koeln.de/plugins/system/jsntplframework/assets/joomlashine/js/noconflict.js" type="text/javascript"></script>
          <script src="http://www.gso-koeln.de/plugins/system/jsntplframework/assets/joomlashine/js/utils.js" type="text/javascript"></script>
          <script src="http://www.gso-koeln.de/templates/jsn_epic_pro/js/jsn_template.js" type="text/javascript"></script>
          <script src="http://www.gso-koeln.de/media/system/js/modal.js" type="text/javascript"></script>
        <script type="text/javascript">
          window.addEvent("load", function() {
                          new JCaption("img.caption");
                      });
                          window.addEvent("domready", function(){
                              JSNISImageShow.alternativeContent();	
                          });
                      
                          JSNTemplate.initTemplate({
                              templatePrefix			: "jsn_epic_pro_",
                              templatePath			: "/templates/jsn_epic_pro",
                              enableRTL				: 0,
                              enableGotopLink			: 1,
                              enableMobile			: 1,
                              enableMobileMenuSticky	: 1,
                              enableDesktopMenuSticky	: 1,
                              responsiveLayout		: ["mobile","wide"]
                          });
                      
                  window.addEvent("domready", function() {
          
                      SqueezeBox.initialize({});
                      SqueezeBox.assign($$("a.modal"), {
                          parse: "rel"
                      });
                  });
            
        </script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0" />
        <!-- html5.js and respond.min.js for IE less than 9 -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="/plugins/system/jsntplframework/assets/3rd-party/respond/respond.min.js"></script>
        <![endif]-->
      </head>
      <body id="jsn-master" class="jsn-textstyle-business jsn-color-blue jsn-direction-ltr jsn-responsive jsn-mobile jsn-joomla-25  jsn-com-content jsn-view-featured jsn-itemid-435 jsn-homepage">
        <a name="top" id="top"></a>
        <div id="jsn-page" class="container">
          <div id="jsn-page-inner">
            <div id="jsn-header">
              <div id="jsn-logo" class="pull-left">
                <a href="/index.php" title="Das Medien- und IT-Berufskolleg in Köln"><img src="img/gso-bk-logo.jpg" alt="Das Medien- und IT-Berufskolleg in Köln" id="jsn-logo-mobile" /><img src="img/gso-bk-logo.jpg" alt="Das Medien- und IT-Berufskolleg in Köln" id="jsn-logo-desktop" /></a>				
              </div>
              <div id="jsn-headerright" class="pull-right">
                <div id="jsn-pos-top" class="pull-left">
                  <div class=" jsn-modulecontainer">
                    <div class="jsn-modulecontainer_inner">
                      <div class="jsn-modulecontent">
                        <span class="jsn-menu-toggle">Menü</span>
                        <ul class="menu-topmenu menu-iconmenu">
                          <li  class="icon-display">		<a class="" href="https://github.com/Dusty0071/OberstufenProjekt" target="_blank" >
                            <span>
                            Das Projekt			</span>
                            </a>
                          </li>
                        </ul>
                        <div class="clearbreak"></div>
                      </div>
                    </div>
                  </div>
                  <div class="clearbreak"></div>
                </div>
              </div>
              <div class="clearbreak"></div>
            </div>
            <div id="jsn-body">
              <div id="jsn-menu">
                <div id="jsn-pos-mainmenu">
                  <div class=" jsn-modulecontainer">
                    <div class="jsn-modulecontainer_inner">
                      <div class="jsn-modulecontent">
    
                        <span class="jsn-menu-toggle">Menü</span>
                        <!-- Nav -->
                        <ul class="menu-mainmenu">
                          <li  class="current active first icon-home"><a class="current" href="index.php" title="Start here..." >
                            <span>
                            <span class="jsn-menutitle">Home</span><span class="jsn-menudescription">Start here...</span>	</span>
                            </a>
                          </li>
                          <li  class="current active first icon-home"><a class="current" href="inhaltsseite.php" title="Dies das" >
                            <span>
                            <span class="jsn-menutitle">Inhaltsseite</span><span class="jsn-menudescription">Dies das</span>	</span>
                            </a>
                          </li>
                        </ul>
                        
                        <div class="clearbreak"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <span id="jsn-desktopswitch">
                <a href="#" onclick="javascript: JSNUtils.setTemplateAttribute("jsn_epic_pro_","mobile","no"); return false;"></a>
                </span>
                <span id="jsn-mobileswitch">
                <a href="#" onclick="javascript: JSNUtils.setTemplateAttribute("jsn_epic_pro_","mobile","yes"); return false;"></a>
                </span>
                <div class="clearbreak"></div>
              </div>
              <div id="jsn-content-top" class="jsn-haspromoright ">
                <div id="jsn-promo" class="row-fluid">
                  <div id="jsn-pos-promo" class="span9 order1 ">
                    <div class="display-desktop jsn-modulecontainer">
                      <div class="jsn-modulecontainer_inner">
                        <div>
                          <div>
                            <div class="jsn-modulecontent">
                              <div  >
                                <p> <br /><img src="img/gso-wall.jpg" border="0" alt="gso-wall" width="672" height="330" style="display: block; margin-left: auto; margin-right: auto;" /></p>
                              </div>
                              <div class="clearbreak"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>';
}

function writeLogin() {
    echo '<div id="jsn-pos-promo-right" class="span3 order2 ">
    <div class="box-grey display-desktop jsn-modulecontainer">
        <div class="jsn-modulecontainer_inner">
            <div>
                <div>
                    <div class="jsn-modulecontent">
                        <div class="loginbox">
                            <p style="text-align: center;"><span style="color: #ffffff; font-size: medium;"><strong> Anmelden am Protokolltool</strong></span></p>
                            <form method="POST" action="#">
                                <input type="text" placeholder="username" />
                                <input type="password" placeholder="passwort" />
                                <input type="submit" value="Anmelden">
                            </form>
                        </div>
                        <div class="clearbreak"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';
}

function writeHeadEnd() {
    echo '<div class="clearbreak"></div>
    </div>
    </div>
    <div id="jsn-content" class="jsn-hasright ">
        <div id="jsn-content_inner">
            <div id="jsn-content_inner1">
                <div id="jsn-content_inner2">
                    <div id="jsn-content_inner3">
                        <div id="jsn-content_inner4">
                            <div id="jsn-content_inner5">
                                <div id="jsn-content_inner6">
                                    <div id="jsn-content_inner7" class="row-fluid" style="background-color: #fff">
                                        <div id="jsn-maincontent" class="span9 order1 offset0 row-fluid">
                                            <div id="jsn-maincontent_inner">
                                                <div id="jsn-maincontent_inner1">
                                                    <div id="jsn-maincontent_inner2">
                                                        <div id="jsn-maincontent_inner3">
                                                            <div id="jsn-maincontent_inner4">
                                                                <div id="jsn-centercol" class="span12 order1 ">
                                                                    <div id="jsn-centercol_inner">
                                                                        <div id="jsn-mainbody-content" class=" jsn-hasmainbodytop jsn-hasmainbody">
                                                                            <div id="jsn-pos-mainbody-top" class="jsn-modulescontainer jsn-horizontallayout jsn-modulescontainer1 row-fluid">
                                                                                <div class=" jsn-modulecontainer span12">
                                                                                    <div class="jsn-modulecontainer_inner">
                                                                                        <div>';
}

function writeFoot() {
    echo '</div>
    </div>
</div>
</div>
<div id="jsn-mainbody">
<div id="system-message-container"></div>
<div class="com-content ">
    <div class="front-page-blog">
    </div>
</div>
</div>
</div>
</div>
</div>
<!-- end centercol -->
</div>
</div>
</div>
</div>
</div>
</div>
<!-- end jsn-maincontent -->
<div id="jsn-rightsidecontent" class="span3 order3 ">
<div id="jsn-rightsidecontent_inner">
<!-- Right Content -->
<div class="jsn-pos-right">
<div class="box-blue icon-star jsn-modulecontainer">
<div class="jsn-modulecontainer_inner">
<div>
<div>
<h3 class="jsn-moduletitle"><span class="jsn-moduleicon">Protokolltool</span></h3>
<div class="jsn-modulecontent">
<div>
<p>Made with &#10084; by:</p>
<ul>
<li>MCGD</li>
<li>newkid</li>
<li>Detlef</li>
<li>Gollnick</li>
</ul>
</div>
<div class="clearbreak"></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div id="jsn-content-bottom">
<!-- Bottom-Content -->
</div>
</div>
<div id="jsn-footer">
<!-- Footer -->
<div class="display-desktop jsn-modulecontainer">
<div class="jsn-modulecontainer_inner">
<div class="jsn-modulecontent">
<div>
<p style="text-align: center;">Das Protokolltool - Gruppe 3</p>
</div>
<div class="clearbreak"></div>
</div>
</div>
</div>
</div>
</div>
</div>
<span>Go to top</span>
</a>
</body>

</html>';
}

function easterEgg() {
    echo'<!-- 
                                MMMMMM=                                      
                           .MMMMMMMMMMMMMM                                   
                         MMMMMM         MMMM                                 
                      MMMMM              MMMMM.                              
                MMMMMMMM                  ?MMMM.                             
             .MMMMMMMM7MM                  MMMMM                             
             MMMMMMMMM MM                   MMMM                             
             MMMMMMMMM .MM                   MMM                             
            .MMMMMMM.   MM.M.   =MMMMMMMM.   MMM                             
             MMMMMMMM.MMMMMM.  MMMMMMMM MMM  MMM                             
             MMMMMMMMMMMM     MMMMMMMMM  MMM MMM                             
            MMM    MMM:  MM   MMMMMMMMM  MMM MMM                             
           8MM.    MMMMMMMM=  MMMMMMMM.  .M ,MM7                             
          MMMMMMMM..          MMMMM.     M  MMM                              
         .MMMMMMMMMMMMMMM       MMMMMMMMM.  MMM                              
        .MMM        MMMMMMMMMMM.           MMMM                              
        MMM                .~MMMMMMM.      MMM.                              
       MMM.                               MMMM                               
      .MMM                                MMMM                               
      MMM                                DMMM                                
     MMM                                 MMMM                                
     MMM                                .MMM                                 
    MMM                      MM        .MMM                                  
    MMM                     .MM  MM.   MMM~                                  
    MMM                     MMM .MM.   MMM                         MMMMM     
    MMM                     MM. MMM   MMM                        MMM   MMO   
    MMM                     MM  MM   .MMM                      MMMM     MM   
    MM~                    MM. MMM   MMM.                     MMM      IMM   
    MM.                    MM  MM.  .MMM                    .MMM.      MM    
    MM                     M  MMN   .MMM                   MMMM       MM.    
    MM+                   MM MMM    .MM 7MMMMMMMMMMM      MMM.       MM      
    MMM                  .M  MM      MMMMMM. .. MMMMMMM MMM.       MMM.      
    MMM                  +M MMM      MM    .MM     .MMMMMM.      .MMM.       
    ?MM                  M  MM       .      MMM      ~MM.       MMMM         
    .MM                 MM  MM            ,MMMMMMMMMMM         MMMM          
     MMM              MM     MM          MMMMMMMMMMMMMMM     MMMMM           
     MMM            .M     N  MM                  ..MMMMM.     MMMM          
     .MM             MMMM MMMMMM                     .MMMMM        DMM       
      MMM              MMMMM.MM.             ,M,       .MMM.        MM       
       MMM               M.                  MMM         MMM.  .MMMM         
       MMMM                                              MMM.    MM          
        =MMM.                            MM.             MMM      MM         
          MMMM.                          MM              MMM       M         
            MMMM                                         MMMMM,. MMM         
 .          MMMMMMM.                     MMM            MMM MMMMMM.          
 MMMM      MMN  .MMMMM                               .MMMD                   
 MM MMN  .MM    MM MMMMMMMM~ .              M.     .MMMM                     
 MM   MM$MM   MMN      MMMMMMMMMM.          M.   .MMMM                       
  M.   MMM   MM              MMMMM  MMMMMMMMM~MMMMMM                         
  MM      .MMN          .. . +MM,  8MM .MMMMMMMM.                            
   M?    NMM           MMMMMMMMM   MM                                        
   .M  .MM7            MMM MMMM   MM                                         
     MMMM              OMM       .MM                                         
      .                 MMM      MM                                          
                        .MMM    MM                                           
                         .MMD  MMM                                           
                           MMMMM?                                            
                            MMM. 
 -->';
}
?>