
    // for getting the ticket pdf for registered event
    $(".event_ticket").click(function(){
      // (orientation,unit, format)
      var pdfDoc = new jsPDF('p','mm','a4');
      pdfDoc.setFont("helvetica");
      // document properties
      pdfDoc.setProperties({
          title: 'Event ticket',
          subject: 'GhIS LSD APP',
          author: 'Sorce Kwarteng',
      });

      pdfDoc.setFontSize(20);
      pdfDoc.setFontType("bold");
      // (width from the left margin, height from top)
      pdfDoc.text(100, 20, 'EVENT TICKET','center');
      // (from margin from left,tilting line,)
      pdfDoc.line(500, 20, 80, 20);
      pdfDoc.rect(100, 20, 10, 10);

      pdfDoc.save('Event_ticket.pdf');

    });




 //  // calculating the days difference between now and the end date set
                   //  var dateObj = new Date();
                   //  var month = dateObj.getUTCMonth() + 1; //months from 1-12
                   //  var day = dateObj.getUTCDate();
                   //  var year = dateObj.getUTCFullYear();
                   //  var todayDate = day + "-" + month + "-" + year;
                   //  // calculate the difference between the two dates
                   //  var today = new Date(28-11-2018);
                   //  var endDate = new Date(jsonObj[0].event_date_end);
                   //  var timeDiff = Math.abs(endDate.getTime() - today.getTime());
                   //  var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 

                   // $("#daysCount").val(diffDays); 

 </script>
 <script src="js/jsPDF.js"></script>