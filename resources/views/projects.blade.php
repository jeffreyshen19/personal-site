@extends('layout')
@section('css',"/styles/projects.css")
@section('navbar')
  @parent
@endsection
@section('content')
  @php
    $colorcode =
    array(
      "app" => "#00008844",
      "film" => "#88000044",
      "paper" => "#00660044"
    );
    $skillpics =
    array(
      "C" => "/images/c.png",
      "Ruby" => "/images/ruby.png",
      "C++" => "/images/cpp.png",
      "Java" => "/images/java.png",
      "Sinatra" => "/images/sinatra.png",
      "Python" => "/images/python.png",
      "LaTeX" => "/images/latex.png",
      "PostgreSQL" => "/images/postgresql.png",
      "MongoDB" => "/images/mongodb.png",
      "NodeJS" => "/images/node.png",
      "HTML/CSS/JS" => "/images/html.png",
      "Adobe Premiere" => "/images/premiere.png",
      "Adobe Photoshop" => "/images/photoshop.png",
      "PHP" => "/images/php.png",
      "Laravel" => "/images/laravel.png"
    );
  @endphp
  <div id = "background">
    <div id = "top-toolbar">
      <div class = "arrow-holder"><button id = "left-arrow" disabled ><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24"><path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"/></svg></button></div>
      <div><h1>Projects</h1></div>
      <div class = "arrow-holder"><button id = "right-arrow"
      @php
        echo(count($projects["projects"]) <= 2 ? "disabled" : "");
      @endphp
      ><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24"><path d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9z"/></svg></button></div>
    </div>
    <div id = "right-hide">
      <div id = "right-grad-box"></div>
      <div id = "right-hide-box"></div>
    </div>
    <div id = "left-hide">
      <div id = "left-hide-box"></div>
      <div id = "left-grad-box"></div>
    </div>
    <div id = "loading-text"><h2>Loading assets...</h2></div>
    <div class = "scrollable-box" id = "projects-box">
      @foreach($projects["projects"] as $proj)
        <div class = "project" style = "border-color: @php echo($colorcode[$proj["type"]]); @endphp">
          <div class = "project-text">
            <div class = "title-time">
              <h2><a href="@php echo($proj["link"]) @endphp">@php echo($proj["name"]); @endphp</a></h2>
              <p style='color: @php echo($proj["complete"]=="In Progress"?"#FFBB44":"#AAAAAA"); @endphp>'>@php echo($proj["complete"]); @endphp</p>
            </div>
            <p>@php echo($proj["description"]); @endphp</p>
          </div>
          <div class = "project-imgs">
            <img class = "project-img" id = "@php echo($proj["name"]) @endphp-img"
            src = "@php echo($proj["image"]) @endphp"></img>
            <div class = "project-skills">
              @foreach($proj["skills"] as $skill)
                <div class = "skill-img" style = "background-image: url('@php echo($skillpics[$skill]); @endphp');
                @php
                  if($skill == 'HTML/CSS/JS' || $skill == 'PHP' || $skill == 'LaTeX') echo('--uninvert:T;');
                @endphp
                " height = "40" width = "40">
                  <span class = "skill-hover" style = "left: -@php echo(strlen($skill) * 7) @endphppx;
                  @php
                    if($skill == 'HTML/CSS/JS') echo('filter: invert(0);');
                  @endphp
                  ">@php echo($skill) @endphp</span>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
  <script>
    var maxboxes = @php echo((count($projects["projects"]) - 2) / 2); @endphp;
    var cSelect = 0;
    function projectsalign()
    {
      $("#loading-text").css("visibility","hidden");
      $("#projects-box").css("opacity",1);
      $("#projects-box").css("margin-left", window.outerWidth / 2  - 495 + cSelect * -990);
      if(Cookies.get('mode') == 'dark')
      {
        $(".project-img").each(function() {
          if($(this).attr("src") == "/images/personal-site-dark.png"){
            $(this).attr("src","/images/personal-site-light.png");
          }
        });
      }
    }
    $("#left-arrow").click(function(event){
      if(cSelect != 0){
        $("#right-arrow").prop('disabled', false);
        cSelect -= 1;
        if(cSelect == 0) $(this).prop('disabled', true);
        $('#projects-box').css('margin-left', window.outerWidth / 2  - 495 + cSelect * -990);
      }
      console.log(cSelect);
    });
    $("#right-arrow").click(function(event){
      if(cSelect != maxboxes){
        $("#left-arrow").prop('disabled', false);
        cSelect += 1;
        if(cSelect >= maxboxes) $(this).prop('disabled', true);
        $('#projects-box').css('margin-left', window.outerWidth / 2  - 495 + cSelect * -990);
      }
    });
  </script>
@stop
