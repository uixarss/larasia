
$(function(){

    $('.date-time').mask('00/00/0000 00:00:00');
    $('.time').mask('00:00:00');

    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
    });


    $("#newListRemainder").click(function () {

        clearMessages('#message');
        resetForm("#formListRemainder");
        $("#modalListRemainder input[name='id']").val('');

        showModalCreateListRemainder = true;

        $('#modalListRemainder').modal('show');
        $("#modalListRemainder #titleModal").text('Tambah List Remainder');
        $("#modalListRemainder button.deleteListRemainder").css("display","none");
    });


    $(document).on('click','.event', function () {

        clearMessages('#message');
        resetForm("#formListRemainder");

        showModalUpdateListRemainder = true;

        let Event = JSON.parse($(this).attr('data-event'));

        $('#modalListRemainder').modal('show');
        $("#modalListRemainder #titleModal").text('Edit List Remainder');
        $("#modalListRemainder button.deleteListRemainder").css("display","flex");

        $("#modalListRemainder input[name='id']").val(Event.id);
        $("#modalListRemainder input[name='title']").val(Event.title);
        $("#modalListRemainder input[name='start']").val(Event.start);
        $("#modalListRemainder input[name='end']").val(Event.end);
        $("#modalListRemainder input[name='color']").val(Event.color);

    });

    $(".saveListRemainder").click(function () {

        let id = $("#modalListRemainder input[name='id']").val();

        let title = $("#modalListRemainder input[name='title']").val();

        let start = $("#modalListRemainder input[name='start']").val();

        let end = $("#modalListRemainder input[name='end']").val();

        let color = $("#modalListRemainder input[name='color']").val();

        let Event = {
            title: title,
            start: start,
            end: end,
            color: color,
        };

        let route;

        if(id == ''){
            route = routeEvents('routeStoreListRemainder');
        }else{
            route = routeEvents('routeUpdateListRemainder');
            Event.id = id;
            Event._method = 'PUT';

        }
        sendEvent(route,Event);

    });


    $(".deleteListRemainder").click(function () {

        let id = $("#modalListRemainder input[name='id']").val();

        let Event = {
            id: id,
            _method:'DELETE'
        };

        let route = routeEvents('routeDeleteListRemainder');

        showModalUpdateListRemainder = true;
        sendEvent(route,Event);

        $(`#boxListRemainder${id}`).remove();

    });


    $(".deleteEvent").click(function() {

      let id = $("#modalCalendar input[name='id']").val();

      let Event = {
        id: id,
        _method:'DELETE'
      };

      let route = routeEvents('routeDeleteEvents');
      sendEvent(route,Event);

    });

    $(".saveEvent").click(function() {

      let id = $("#modalCalendar input[name='id']").val();

      let title = $("#modalCalendar input[name='title']").val();

      let start = moment($("#modalCalendar input[name='start']").val(),"DD/MM/YYYY HH:mm:ss").format("YYYY-MM-DD HH:mm:ss");

      let end = moment($("#modalCalendar input[name='end']").val(),"DD/MM/YYYY HH:mm:ss").format("YYYY-MM-DD HH:mm:ss");

      let color = $("#modalCalendar input[name='color']").val();

      let description = $("#modalCalendar textarea[name='description']").val();

      let Event = {
          title: title,
          start: start,
          end: end,
          color: color,
          description: description,
      };

      let route;
      if (id == '') {
        route = routeEvents('routeStoreEvents');
      }else {
        route = routeEvents('routeUpdateEvents');
        Event.id = id;
        Event._method = 'PUT';
      }

      sendEvent(route,Event);

    });


});

let objCalendar;
let showModalUpdateListRemainder = false;
let showModalCreateListRemainder = false;

function sendEvent(route, data_) {
    $.ajax({
      url     : route,
      data    : data_,
      method  : 'POST',
      dataType:'json',
      success : function (json) {

        setInterval(function() {
            location.reload();
        }, 1000);

        if (json) {
              objCalendar.refetchEvents();
              $("#modalCalendar").modal('hide');
          }

          if(showModalUpdateListRemainder === true){
              showModalUpdateListRemainder = false;
              $("#modalListRemainder").modal('hide');

              let stringJson = `{"id":"${data_.id}","title":"${data_.title}","color":"${data_.color}","start":"${data_.start}","end":"${data_.end}"}`;

              $(`#boxListRemainder${data_.id}`).attr('data-event', stringJson);
              $(`#boxListRemainder${data_.id}`).text(data_.title);
              $(`#boxListRemainder${data_.id}`).css({
                  "backgroundColor": `${data_.color}`,
                  "border": `1px solid ${data_.color}`});

          }

          if(showModalCreateListRemainder === true){
              showModalCreateListRemainder = false;
              $("#modalListRemainder").modal('hide');

              let stringJson = `{"id":"${json.created}","title":"${data_.title}","color":"${data_.color}","start":"${data_.start}","end":"${data_.end}"}`;

              let newEvent = `<div id="boxListRemainder${json.created}"
                      style="padding: 4px; border: 1px solid ${data_.color}; background-color: ${data_.color}"
                      class='fc-event event text-center'
                      data-event='${stringJson}'>
                      ${data_.title}
                  </div>`;
              $('#external-events-list').append(newEvent);

          }
      },
      error:function (json) {

            let responseJSON = json.responseJSON.errors;

            $("#message").html(loadErrors(responseJSON));
        }
    });
}

function loadErrors(response) {

  let boxAlert = `<div class="alert alert-danger">`;

  for (let fields in response){
      boxAlert += `<span>${response[fields]}</span><br/>`;
  }

  boxAlert += `</div><br/><br/><br/><br/>`;

  return boxAlert.replace(/\,/g,"<br/>");

}

function routeEvents(route) {
  return document.getElementById('calendar').dataset[route];
}

function clearMessages(element){
    $(element).text('');
}

function resetForm(form) {
  $(form)[0].reset();
}
