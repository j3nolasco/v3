<?php
$jsonString = file_get_contents('Data.json', FILE_USE_INCLUDE_PATH);
$data = json_decode($jsonString, true);
$reportEntries = $data['Report_Entry']; 

$arrayCount = count($data);
 

foreach($data as $key => $value){
  $arrayCount = count($value);
} 
$Rentry = $data['Report_Entry'];
$Temp = "";
for( $i=0; $i < 1; $i++){
    $firstReport = $Rentry[$i];
    $Temp = $firstReport['Academic_Period'];
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>v3</title>
</head>
<body>
<div class = "course-catalog"> 
    <section class = "left">
        <div class = "filter-container">
            <div class = "filter-content">
                <h1 class = "filter">Filter</h1>
                <input type="text" id="myInput" onkeyup="filterByName(this)" placeholder="Search for courses...">
                <h1>academic-period</h1>
                <select name="academic-periods" id="inputPeriod" >
                    <option value="<?=$Temp ?>" disabled selected> Select Academic Period </option>
                <?php
                         $new_array = array();
                         for ( $i = 0; $i < $arrayCount; $i++ ){
                             $firstReport = $Rentry[$i];
                             $AcademicPeriod = $firstReport['Academic_Period'];
                             if(!in_array($AcademicPeriod, $new_array)){ 
                                  $new_array[$i] = $AcademicPeriod;
                                  $NewAcademicPeriod = $new_array[$i];
                                  ?>
                                  <option value="<?=$NewAcademicPeriod ?>"><?=$NewAcademicPeriod ?></option>"
                                  <?php
                                }
                             ?>                           
                         <?php
                         }?>
                </select>
                
                <h1>Academic Level</h1>
                <select name="delivery-mode" id="inputAcademic"  >
                    <option value="Undergraduate" disabled selected> Select Delivery Mode </option>
                <?php
                         $new_array = array();
                         for ( $i = 0; $i < $arrayCount; $i++ ){
                             $firstReport = $Rentry[$i];
                             $AcademicLevel = $firstReport['Academic_Level'];
                             if(!in_array($AcademicLevel, $new_array)){ 
                                  $new_array[$i] = $AcademicLevel;
                                  $AcademicLevel = $new_array[$i];
                                  ?>
                                  <option value="<?=$AcademicLevel ?>"><?=$AcademicLevel ?></option>"
                                  <?php
                                }
                             ?>                           
                         <?php
                         }?>
                </select>
                <br></br>
                <button onclick="resetValues()">reset</button>
            </div>
        </div>
    </section>
    <section class ="right">
        <div class = "courses-container">
                <div class = "course-content">
                    <h1 class = "title">Courses</h1>
                    <div class = "courses-grid" id = "list">
                        <?php
                            for ( $i = 0; $i < $arrayCount; $i++ ){
                                $firstReport = $Rentry[$i];
                                $CourseListing = $firstReport['Course_Listing'] ;
                                $CourseSubjects = $firstReport['Course_Subjects'];
                                $SectionCapacity = $firstReport['Section_Capacity'];
                                $AcademicLevel = $firstReport['Academic_Level'];
                                $DeliveryMode = $firstReport['Delivery_Mode'];
                                $StartDate = $firstReport['Start_Date'];
                                $EndDate = $firstReport['End_Date'];
                                $AcademicPeriod = $firstReport['Academic_Period'];
                                $count = $i;
                                if(array_key_exists('Meeting_Pattern', $firstReport))
                                        {
                                            $MeetingPattern = $firstReport['Meeting_Pattern'];
                                          
                                        }else{
                                            $MeetingPattern = 'NA';
                                        }
                                if(array_key_exists('Instructors', $firstReport))
                                        {
                                            $Instructor = $firstReport['Instructors'];
                                        
                                        }else{
                                            $Instructor = 'NA';
                                        }
                                if(array_key_exists('Requirements', $firstReport))
                                        {
                                            $Requirements = $firstReport['Requirements'];
                                          
                                        }else{
                                            $Requirements = 'No Requirements';
                                        }
                                if(array_key_exists('Course_Description', $firstReport))
                                        {
                                            $CourseDescription = $firstReport['Course_Description'];
                                          
                                        }else{
                                            $CourseDescription = 'Not Listed';
                                        }
                            
                                ?>
                                
                                <div class = "course-card" id="<?=$i ?>"  onclick ="drillSlide(this)">

                                    <div class = "course-card_L">
                                        <h3  class = "course-listing"><?=$CourseListing ?></h3>
                                        <p style = "display: inline;" class = "course-subjects"><?=$CourseSubjects ?> |</p> 
                                        <p style = "display: inline;" class = "delivery-mode">  <?=$DeliveryMode ?></p>
                                        <p  style = "display: none;" class = "Academic-Period"><?=$AcademicPeriod ?></p>
                                        <br></br>
                                        <p style = "display: inline;">Instructor | </p>
                                        <p  style = "display: inline;"class = "instructor"><?=$Instructor ?></p>
                                       
                                    </div>
                                    <div class = "course-card_R">
                                        <p class = "meeting-pattern"><?=$MeetingPattern ?></p> 
                                        <p class = "academic_level"><?=$AcademicLevel ?></p>
                                          <p id = "indicator" class = "indicator">^</p> 
                                    </div>
                                    <div id = "slide-info"class = "slide-info" style="display:none">
                                        <p> <?=$AcademicPeriod ?></p> 
                                        <p> <?=$StartDate ?></p> 
                                        <p> <?=$EndDate ?></p> 
                                        <p> <?=$CourseDescription ?></p>
                                        <p> <?=$Requirements ?></p>       
                                    </div>
                                </div>
                               
                            <?php
                            }?>
                                <div class = "drill-down" id = "drill" style="display:none">    
                                    <?php
                                    for ( $j = 0; $j < $arrayCount; $j++ ){
                                        $firstReport = $Rentry[$j];
                                        $CourseListing = $firstReport['Course_Listing'] ;
                                        $CourseSubjects = $firstReport['Course_Subjects'];
                                        $SectionCapacity = $firstReport['Section_Capacity'];
                                        $AcademicLevel = $firstReport['Academic_Level'];
                                        $DeliveryMode = $firstReport['Delivery_Mode'];
                                        $AcademicPeriod = $firstReport['Academic_Period'];
                                        $StartDate = $firstReport['Start_Date'];
                                        $EndDate = $firstReport['End_Date'];
                                        
                                        $count = $j;
                                        if(array_key_exists('Requirements', $firstReport))
                                        {
                                            $Requirements = $firstReport['Requirements'];
                                          
                                        }else{
                                            $Requirements = 'No Requirements';
                                        }
                                        if(array_key_exists('Course_Description', $firstReport))
                                        {
                                            $CourseDescription = $firstReport['Course_Description'];
                                          
                                        }else{
                                            $CourseDescription = 'Not Listed';
                                        }
                                        
                                       
                                ?>
                                    <div class ="drill-info" id = "drill-info" style="display:none">
                                        <a style = "display:none"><?=$j ?></a>
                                        <h3 class = "course-listing"><?=$CourseListing ?></h3>
                                        <p class = "course-subjects"><?=$CourseSubjects ?></p>  
                                        <p class = "academic-period"> <?=$AcademicPeriod ?></p> 
                                        <p class = "delivery-mode"><?=$DeliveryMode ?></p>
                                        <h4 style = "display: inline">Start Date: </h4> <p style = "display: inline"class = "start-date"><?=$StartDate ?></p>
                                        
                                        <h4 style = "display: inline">End Date: </h4><p style = "display: inline" class = "end-date"><?=$EndDate ?></p>
                                        <br></br>
                                        <h4>Course Summary</h4>
                                        <p class = "course-description"><?=$CourseDescription ?></p>
                                        <h4>Course Requirements</h4>
                                        <p class = "requirements"><?=$Requirements ?></p>     
                                    </div>  
                                    <?php
                                }?> 
                                </div>
                                <div class = "shadow" id = "shadow" style="display:none"></div>
                    </div>
                </div>
        </div>
    </section>
</div>

<script>
    const Textinput =document.getElementById("myInput");
    Textinput.addEventListener("input",filterByName());


    const input = document.getElementById("inputPeriod");
    const filter = input.value.toUpperCase();
    const list =document.getElementById("list");
    const div = list.getElementsByClassName("course-card");
    var sels =document.getElementsByTagName('select');
    var filterArray = [];
    var serachValue = "";

    var courseSerach= false;
    var ap = false;
    var dm = false;
    var al = false;
    var mp = false;
    var selected_Period = document.getElementById("inputPeriod").value.toUpperCase();   
    var selected_Academic = document.getElementById("inputAcademic").value.toUpperCase();

    var apSelection = "";
    var dmSelection = "";
    var alSelection = "";

    function resetValues(){
        const filter = Textinput.value.toUpperCase();
        const list =document.getElementById("list");
        const div = list.getElementsByClassName("course-card");
        Textinput.value = "";
      for(i=0; i<sels.length; i++){
        sels[i].selectedIndex=0;
      }
      
      
        for(i=0; i < div.length; i++){
                
                    div[i].style.display = "";
                   
                
            }
        }
    

        //filter dropdowns -----------------------------------------------------------------------------------------------------------------

        for(j=0; j<sels.length; j++){
          sels[j].addEventListener('change', function(){
            selectionId = this.id;

            var selectedPeriod =document.getElementById("inputPeriod").value.toUpperCase();
            var selectedAcademic = document.getElementById("inputAcademic").value.toUpperCase();

                        
            if(selectionId === "inputPeriod")
            {
                ap = true;
                if(courseSerach == true)
                {
                    if ( al ){
                    
                    for(i = 0; i<filterArray.length; i++)
                  {
                      const h3 = filterArray[i].getElementsByTagName("h3")[0];
                      const p = filterArray[i].getElementsByTagName("p")[2];
                      const als = filterArray[i].getElementsByTagName("p")[6];
                      
                   
                      if((p.innerHTML.toUpperCase() == selectedPeriod) && (als.innerHTML.toUpperCase() == selectedAcademic))
                      {
                        filterArray[i].style.display = "";
                        apSelection = p.innerHTML;
                        selected_Period =selectedPeriod;

                      }else{
                        filterArray[i].style.display = "none";
                      }
                  } 
                }else{
                
                  for(i = 0; i<filterArray.length; i++)
                  {
                      const p = filterArray[i].getElementsByTagName("p")[2];
                      
                       
                      if(p.innerHTML.toUpperCase() == selectedPeriod)
                      {
                        filterArray[i].style.display = "";
                        apSelection = p.innerHTML;
                        selected_Period =selectedPeriod;
                        //console.log("P: "+p.innerHTML);

                      }else{
                        filterArray[i].style.display = "none";
                      }
                  }    
                } 
                }else{
                    if ( al ){
                    
                    for(i = 0; i<div.length; i++)
                  {
                      const h3 = div[i].getElementsByTagName("h3")[0];
                      const p = div[i].getElementsByTagName("p")[2];
                      const als = div[i].getElementsByTagName("p")[6];
                      
                   
                      if((p.innerHTML.toUpperCase() == selectedPeriod) && (als.innerHTML.toUpperCase() == selectedAcademic))
                      {
                        div[i].style.display = "";
                        apSelection = p.innerHTML;
                        selected_Period =selectedPeriod;

                      }else{
                        div[i].style.display = "none";
                      }
                  } 
                }else{
                
                  for(i = 0; i<div.length; i++)
                  {
                      const p = div[i].getElementsByTagName("p")[2];
                      
                       
                      if(p.innerHTML.toUpperCase() == selectedPeriod)
                      {
                        div[i].style.display = "";
                        apSelection = p.innerHTML;
                        selected_Period =selectedPeriod;
                        //console.log("P: "+p.innerHTML);

                      }else{
                        div[i].style.display = "none";
                      }
                  }    
                } 
                }
                  
            }
            
            if(selectionId === "inputAcademic")
            {
              al = true;
              if(courseSerach == true)
              {
                if(ap)
              {

                for(var i =0; i<filterArray.length; i++)
                {
                    const h3 = filterArray[i].getElementsByTagName("h3")[0];
                    const ap = filterArray[i].getElementsByTagName("p")[2];
                    const p = filterArray[i].getElementsByTagName("p")[6];

                        
                      if( (ap.innerHTML.toUpperCase() == selectedPeriod) && (p.innerHTML.toUpperCase() == selectedAcademic))
                      {
                        filterArray[i].style.display = "";
                       alSelection = p.innerHTML;
                       selected_Academic = selectedAcademic;

                      }else{
                        filterArray[i].style.display = "none";
                      }
                }

              }else{
                for(var i =0; i<filterArray.length; i++)
                {
               
                    const p = filterArray[i].getElementsByTagName("p")[6];
                    
                      if(p.innerHTML.toUpperCase() == selectedAcademic)
                      {
                        filterArray[i].style.display = "";
                        alSelection = p.innerHTML;
                        selected_Academic = selectedAcademic;

                      }else{
                        filterArray[i].style.display = "none";
                      }
                }
              }
              }else{
                if(ap)
              {

                for(var i =0; i<div.length; i++)
                {
                    const h3 = div[i].getElementsByTagName("h3")[0];
                    const ap = div[i].getElementsByTagName("p")[2];
                    const p = div[i].getElementsByTagName("p")[6];

                        
                      if( (ap.innerHTML.toUpperCase() == selectedPeriod) && (p.innerHTML.toUpperCase() == selectedAcademic))
                      {
                       div[i].style.display = "";
                       alSelection = p.innerHTML;
                       selected_Academic = selectedAcademic;

                      }else{
                        div[i].style.display = "none";
                      }
                }

              }else{
                for(var i =0; i<div.length; i++)
                {
               
                    const p = div[i].getElementsByTagName("p")[6];
                    
                      if(p.innerHTML.toUpperCase() == selectedAcademic)
                      {
                        div[i].style.display = "";
                        alSelection = p.innerHTML;
                        selected_Academic = selectedAcademic;

                      }else{
                        div[i].style.display = "none";
                      }
                }
              }
              }   
            }
            if(selectionId === "inputMP")
            {
                mp = true;
                if (dm || al ||ap){
                    
                    for(i = 0; i<div.length; i++)
                  {
                      const h3 = div[i].getElementsByTagName("h3")[0];
                      const p = div[i].getElementsByTagName("p")[2];
                      const dms = div[i].getElementsByTagName("p")[4];
                      const als = div[i].getElementsByTagName("p")[10];
                      
                   
                      if((p.innerHTML.toUpperCase() == selectedPeriod) && (dms.innerHTML.toUpperCase() == selectedMode) && (als.innerHTML.toUpperCase() == selectedAcademic))
                      {
                        div[i].style.display = "";
                        apSelection = p.innerHTML;
                        selected_Period =selectedPeriod;

                      }else{
                        div[i].style.display = "none";
                      }
                  } 
                }else{
                
                  for(i = 0; i<div.length; i++)
                  {
                      const p = div[i].getElementsByTagName("p")[8];
                      
                       
                      if(p.innerHTML.toUpperCase().indexOf(selectedPeriod) > -1)
                      {
                        div[i].style.display = "";
                        apSelection = p.innerHTML;
                        selected_Period =selectedPeriod;
                        //console.log("P: "+p.innerHTML);

                      }else{
                        div[i].style.display = "none";
                      }
                  }    
                }   
            }
          }, false);}

          // end of drop downs----------------------------------------------------------------------------------------------------------
   
function filterByName(){
    const filter = Textinput.value.toUpperCase();
    const list =document.getElementById("list");
    var div = list.getElementsByClassName("course-card");
    var selected_Period = document.getElementById("inputPeriod").value.toUpperCase(); 
    console.log(selected_Period);
    filterArray = [];

    serachValue =filter;

      if(al ||  ap)
      {
        for(i=0; i < div.length; i++){
            const h3 = div[i].getElementsByTagName("h3")[0];
            const ap = div[i].getElementsByTagName("p")[2];
            const ins = div[i].getElementsByTagName("p")[4];
            const als = div[i].getElementsByTagName("p")[6];   

            if((h3)){
                if(((h3.innerHTML.toUpperCase().indexOf(filter) > -1) ||  (ins.innerHTML.toUpperCase().indexOf(filter) > -1)) && (ap.innerHTML.toUpperCase() == selected_Period) && (als.innerHTML.toUpperCase() == selected_Academic)){
                    div[i].style.display = "";
                   
                } else {
                    div[i].style.display = "none";
                    
                }
            }
        }
    } else{
        
        for(i=0; i < div.length; i++){
            const h3 = div[i].getElementsByTagName("h3")[0];
            const ins = div[i].getElementsByTagName("p")[4];
            //console.log("p: "+ ins.innerHTML);
            
            if(h3 || ins){
                if(h3.innerHTML.toUpperCase().indexOf(filter) > -1 || ins.innerHTML.toUpperCase().indexOf(filter) > -1){
                    div[i].style.display = "";
                    courseSerach = true;
                    filterArray.push(div[i]);
                } else {
                    div[i].style.display = "none";
                    courseSerach = true;
                }
            }
        }
    } 
        
    }
    function drillSlide(e){
        var slide =document.getElementById("slide-info");
        var slideinfo = document.getElementsByClassName("slide-info");
        var exit =document.getElementById("leave");
        var list =document.getElementById("list");
        var div = list.getElementsByClassName("course-card");
        var indicator = document.getElementsByClassName("indicator");
        var parent  = e.id;

        for(i=0; i < slideinfo.length; i++){          
            if(i == parent && slideinfo[i].style.display == "none")
            {
                slideinfo[i].style.transition = "all 2s ease-in-out"; 
                slideinfo[i].style.display = "block";   
                console.log("I am drilling");   
                indicator[i].style.transform  = 'rotate('+180+'deg)'; 
            }
            else if(i == parent && slideinfo[i].style.display == "block")
            {
                slideinfo[i].style.display = "none";
                indicator[i].style.transform  = 'rotate('+360+'deg)'; 
                console.log("I am closing"); 
            }
            
        }
    }
    function drillBox(element){
        const shadow =document.getElementById("shadow");
        const exit =document.getElementById("leave");
        const drillDown =document.getElementById("drill");
        const drillInfo =drillDown.getElementsByClassName("drill-info");
        const list =document.getElementById("list");
        const div = list.getElementsByClassName("course-card");
        drillDown.style.display = "block";
        shadow.style.display="block";
        exit.style.display="block";   

        const parent  = element.id;
      

        for(i=0; i < drillInfo.length; i++){
          const h3c = div[i].getElementsByTagName("h3")[0];
          const h3d = drillInfo[i].getElementsByTagName("h3")[0]; 
       
            if(i == parent)
            {
                drillInfo[i].style.display = "block";             
            }else {
                drillInfo[i].style.display = "none";
            }
        }
    }
   
    function closeDrill(element){
        const slide =document.getElementById("slide-info");
        var slideinfo = document.getElementsByClassName("slide-info");
        var parent  = element.id;
        console.log("Parent: " + parent);
        console.log("close");   

        for(i=0; i < slideinfo.length; i++){
            if(i == parent && slideinfo[i].style.display == "block")
            {
                slideinfo[i].style.display = "none";  
            }
        }
    }
    

</script>
<style>

body{
    margin: 0;
    padding: 0;
}
.course-catalog{
   display: flex;
   height: 100%;
   width: 100%;
}
.left{ 
    width: 25%;
    float: left;
}
.right{
    float: left;
    width: 90%;
}

.filter-container{
    position: fixed !important;
    display: flex;
    background-color: darkolivegreen;
    color: white;
    box-shadow: 0px 0px 10px rgb(0 0 0 / 10%);
    height: 100%;
    width: auto;
    flex-direction: row;
    padding: 2rem;
    gap: 2rem;
    overflow-y: hidden !important;

}

.courses-grid{
    display: grid;
    grid-template-columns: 1fr ;
    grid-template-rows: auto auto;
    gap: 1rem;
}
.course-card{
    display: block;
    grid-template-columns: (2 ,1fr);
    background-color: lightgray;
    box-shadow: 0px 0px 10px rgb(0 0 0 / 10%);
    border-radius: .2rem;
    height: auto;
    width: 95%;
    padding: 1rem; 
    padding-top: .2rem !important;
    gap: 2rem;
    
}  

.course-card_L{
    grid-column: 1;
    float: left;
    margin-bottom: 1rem;

    
}
.indicator{
   position:absolute;
    bottom:1;
    right:1;
}
.course-card_R{
    margin-left: 5rem;
    margin-bottom: 1rem;
    grid-column: 2;
    float: left;
}

.drill-down{
    position: fixed;
    z-index: 2;
    background-color: lightgray;
    box-shadow: 0px 0px 10px rgb(0 0 0 / 10%);
    border-radius: 1.7rem;
    inset: 0px;
    width: 700px;
    height: 700px;
    margin: auto;
   
    
}
.slide-info{
    margin-top: 9rem;
    list-style: none;
    
}
.leave{

    z-index: 5;
    background-color: lightgray;
    border-radius: 1.7rem;
    height: 50px;
    width: 50px;
    left: 900px
  
}
.shadow{
    position: absolute;
    z-index: 1;
    box-shadow: 0 0 0 99999px rgba(0, 0, 0, .5);
}



@media screen and (max-width: 430px){
    body{
    margin: 0;
    padding: 0;
}
    .course-catalog{
        display: inline-block;
        
    }
   .left{ 
        width: 100%;
   }

    .right{
  
      
  
    }
   .filter-container{
    position: fixed !important;
    
    background-color: darkolivegreen;
    color: white;
    box-shadow: 0px 0px 10px rgb(0 0 0 / 10%);
    height: 5%;
    width: 100%;
    flex-direction: row;
    padding: 2rem;
   }
   .courses-grid{
    padding: .5rem;
}
   .course-card{
    display: block;
    vertical-align: middle;
    background-color: lightgray;
    box-shadow: 0px 0px 10px rgb(0 0 0 / 10%);
    border-radius: .2rem;
    height: auto;
    width: 100%;
    padding: 1rem;

}  
    .course-card_L{

    margin-bottom: 0rem;

    
}
    .indicator{
    position:absolute;
    bottom:1;
    right:1;
}
    .course-card_R{
    margin-left:0;
    margin-bottom: 0rem;
   
  
    
}
.slide-info{
    margin-top: 15rem;
    
    
}

}
</style>                           
</body>
</html>