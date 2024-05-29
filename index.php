<?php require_once('couch/cms.php'); ?>
<cms:repeatable name="sections" label="Insert Sections">
  <cms:editable name="section-label" type="text" label="Section Label, will be displayed as a header"/>
</cms:repeatable>
<cms:func 'make-cms-backend' name='' labelText=''>
  <cms:repeatable name="<cms:show name/>_item" label="Items for <cms:show labelText/> Section ">
    <cms:editable name="<cms:show name/>_item_section_id" type="text" label="Section id -- items with same id will be grouped in same element. Only 1 unique 'staff' element allowed and it must have unique id ">1</cms:editable>
    <cms:editable name="<cms:show name/>_show_image_or_text"  type="dropdown" label="Section Type" desc="Select One" opt_values = "text|image|staff|hidden"/>
    <cms:editable name="<cms:show name/>_item_title" type="text" label="<cms:show labelText/> - Title - will only show if text is set to show. First appearing title in either text or hidden element will be used for the anchor in the menu for this item">
      Title
    </cms:editable>
    <cms:editable name="<cms:show name/>_item_text" type="text" label="<cms:show labelText/> - Text - will only show if text is set to show">
      Text
    </cms:editable>
    <cms:editable name="<cms:show name/>_item_img" label="<cms:show labelText/> - Image - will only show if image is set to show" type="image" hidden='1'></cms:editable>
  </cms:repeatable>
</cms:func>
<cms:func 'make-staff-backend' parent='' labelText='' >
  <cms:repeatable name="<cms:show parent/>_staff" label="Insert Staff Information Here for parent <cms:show labelText/>">
    <cms:editable name="<cms:show parent/>_staff_name" type="text" label="Staff Name">name</cms:editable>
    <cms:editable name="<cms:show parent/>_staff_school" type="text" label="Staff School/Grade Level">ABRHS</cms:editable>
    <cms:editable name="<cms:show parent/>_staff_contact" type="text" label="Staff Contact">staff@abschools.org</cms:editable>
    <cms:editable name="<cms:show parent/>_staff_image" type="image" hidden='1'></cms:editable>
  </cms:repeatable>
</cms:func>
<!-- This made me cry in school -->
<cms:func "make-section" name='' labelText='' repeat='0'>
  <cms:set item_section_id="<cms:concat name '_item_section_id'/>"/>
  <cms:set item_img = "<cms:concat name '_item_img' />"/>
  <cms:set item_show_image_or_text = "<cms:concat name '_show_image_or_text'/>"/>
  <cms:set item_title = "<cms:concat name '_item_title'/>"/>
  <cms:set item_text = "<cms:concat name '_item_text'/>"/>
  <div class="header first-header" id="<cms:show name/>">
     <h3><cms:show labelText/></h3>
  </div>
  <div class="lines">
    <div>
      <cms:show_repeatable "<cms:concat name '_item'/>" startcount="0">
        <cms:if cur_id != "<cms:get item_section_id />">
        <cms:incr repeat/>
        <cms:if k_count != '0'>
                </div>
              </cms:if>
              <div class="items" id="<cms:show name/>-<cms:show repeat/>">
              <cms:set cur_id = "<cms:get item_section_id />"/>
        </cms:if>
        <cms:set image_text_switch = "<cms:get item_show_image_or_text/>"/>
        <cms:if image_text_switch = "staff">
          <cms:set staff_id="<cms:concat name '_item_' k_count />"/>
          <cms:set staff_label="<cms:concat labelText '_' k_count />"/>
          <cms:call 'make-staff-backend' staff_id staff_label/>
          <cms:set staff_image = "<cms:concat staff_id '_staff_image'/>"/>
          <cms:set staff_school = "<cms:concat staff_id '_staff_school'/>"/>
          <cms:set staff_contact = "<cms:concat staff_id '_staff_contact'/>"/>
          <cms:set staff_name = "<cms:concat staff_id '_staff_name'/>"/>
          <div class="staff">
            <div class="title">
              <h4>STAFF</h4>
            </div>
            <cms:show_repeatable "<cms:concat staff_id '_staff'/>">
              <div class="member">
                <figure>
                  <img src="<cms:get staff_image/>">
                </figure>
                <div class="description">
                  <h5><cms:get staff_name/></h5>
                  <h6><cms:get staff_school/></h6>
                  <h6><cms:get staff_contact/></h6>
                </div>
              </div>
            </cms:show_repeatable>
            </div>
        <cms:else/>
          <div class="text-item <cms:get item_show_image_or_text/>">
            <h3><cms:get item_title/></h3>
            <p><cms:get item_text/></p>
          </div>
          <figure class="<cms:get item_show_image_or_text/>">
            <img src="<cms:get item_img/>">
          </figure>
        </cms:if>
      </cms:show_repeatable>
      </div>
    </div>
  </div>
</cms:func>
<cms:func "make-nav" name='' labelText='' repeat='0' set='false'>
  <cms:set item_section_id="<cms:concat name '_item_section_id'/>"/>
  <cms:set item_title="<cms:concat name '_item_title'/>"/>
  <cms:set item_show_image_or_text = "<cms:concat name '_show_image_or_text'/>"/>
  <li><a class="mobile-only"> <cms:show labelText /> </a><a href="#<cms:show name/>" class="pc-only"> <cms:show labelText /> </a>
    <ul>
      <cms:show_repeatable "<cms:concat name '_item' />">
        <cms:if cur_id != "<cms:get item_section_id/>">
          <cms:incr repeat/>
          <cms:set cur_id = "<cms:get item_section_id/>" />
          <cms:set set = "false"/>
        </cms:if>
        <cms:set image-text-switch= "<cms:get item_show_image_or_text />"/>
        <cms:if (image-text-switch!="image") && (set="false") >
          <li><a href="#<cms:show name/>-<cms:show repeat/>"><cms:get item_title/></a></li>
          <cms:set set="true"/>
        </cms:if>
      </cms:show_repeatable>
    </ul>
  </li>
</cms:func>
<cms:show_repeatable 'sections'>
  <cms:call 'make-cms-backend' k_count section-label/>
</cms:show_repeatable>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>ABRHS PE/HE</title>
  <link href="img/logo_light.png" rel="icon">
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Questrial" rel="stylesheet">
  <link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <div id="nav-wrapper" class="nav-vars">
    <nav>
      <div id="items-wrapper">
        <div id="items">
          <figure><img src="img/logo.png"></figure>
          <h1><span class="hidden">AB</span>RHS PE/HE</h1>
        </div>
      </div>
    </nav>
    <div id="nav-background"></div>
    <div id="menu-wrapper">
      <ul id="menu">
        <cms:show_repeatable 'sections'>
          <cms:call 'make-nav' k_count section-label/>
        </cms:show_repeatable>
        <li><a href="https://abrhs.abschools.org/"> ABRHS </a>
        </li>
      </ul>
    </div>
  </div>
  <div id="nav-placeholder" class="nav-vars"></div>

  <main>
    <div class="title">
       <h2>Acton Boxborough Physical Education</h2>
    </div>
    <cms:show_repeatable 'sections'>
      <cms:call 'make-section' k_count section-label/>
    </cms:show_repeatable>
  </main>
  <footer>
    <div id="copyright">
      <p>
        Copyright © 2023 ABRSD. All Rights Reserved. ABRSD does not discriminate on the basis of race, color, sex, sexual orientation, gender identity, religion, disability, pregnancy and pregnancy-related conditions, age, active military/veteran status, ancestry, or national or ethnic origin in the administration of its educational policies, employment policies, and other administered programs and activities. In addition, students who are homeless or of limited English-speaking ability are protected from discrimination in accessing the course of study and other opportunities available through the schools. Read our Nondiscrimination Notice and Website Accessibility Statement. If you find a problem that prevents access, please contact the webmaster. Inquiries will be responded to within 5-7 business days.
      </p>
    </div>
    <div id="border"></div>
    <div id="information">
      <p class="school-name">
        Acton-Boxborough Regional High School
      </p>
      <p class="credit">
        Website by <a href="https://github.com/catmajor">Nikita Ostapenko '24</a><br>
        And <a href="">Eric Feng '27</a>
      </p>
      <p class="address">
        36 Charter Road, Acton, MA01720 <br>
        Phone 978-264-4700 <br>
        Powered by <a href="https://www.couchcms.com/">Couch CMS</a>
      </p>
    </div>
  </footer>
  <script src="script.js"></script>
</body>

</html>
<?php COUCH::invoke(); ?>