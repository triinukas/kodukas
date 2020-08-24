        var town = "";
        var id_town = 0;
        var language = "";
        var id_language = 0;
        var subject = "";
        var id_subject = 0;

        function addTownRow(){
            var btnDeleteHtml = "<input class='btn btn-outline-danger townId"+id_town+"' type='button' value='X' id='townTableBodyButtonDelete'>";
            if(town != ""){                        
                $("#townTableBody").append(
                    "<tr class='townId"+id_town+"'><td><input type='text' name='townId"+id_town+"'class='tableTextInput' value='"+town+"' readonly></td><td class='text-right'>"+btnDeleteHtml+"</td> </tr>"
                );
                id_town++;
            }
        }
        function addLanguageRow(){
            var btnDeleteHtml = "<input class='btn btn-outline-danger languageId"+id_language+"' type='button' value='X' id='languageTableBodyButtonDelete'>";
            if(language != ""){                        
                $("#languageTableBody").append(            
                    "<tr class='languageId"+id_language+"'><td><input type='text' name='languageId"+id_language+"'class='tableTextInput' value='"+language+"' readonly></td><td class='text-right'>"+btnDeleteHtml+"</td> </tr>"
                );
                id_language++;
            }
        }
        function addSubjectRow(){
            var btnDeleteHtml = "<input class='btn btn-outline-danger subjectId"+id_subject+"' type='button' value='X' id='subjectTableBodyButtonDelete'>";
            if(subject != ""){
                $("#subject").val("");
                $("#subjectTableBody").append(
                    "<tr class='subjectId"+id_subject+"'><td><input type='text' name='subjectId"+id_subject+"'class='tableTextInput' value='"+subject+"' readonly></td><td class='text-right'>"+btnDeleteHtml+"</td> </tr>"
                );
                id_subject++;
            }
        }
                                            
        $('#townTableBody').on('click', '#townTableBodyButtonDelete', function() {
            var myClass = $(this).attr("class").split(' ');
            var getCurrentid = myClass[2];
            $("tr." + getCurrentid).remove();
        });
        $('#languageTableBody').on('click', '#languageTableBodyButtonDelete', function() {
            var myClass = $(this).attr("class").split(' ');
            var getCurrentid = myClass[2];
            $("tr." + getCurrentid).remove();
        });
        $('#subjectTableBody').on('click', '#subjectTableBodyButtonDelete', function() {
            var myClass = $(this).attr("class").split(' ');
            var getCurrentid = myClass[2];
            $("tr." + getCurrentid).remove();
        });