var previousYObject = {};
$(document).ready(function () {
    $(".drag-container .draggable-item").each(function(e) {
        previousYObject[$(this).attr("id")] = $(this).offset().top
    })

    // Make the element draggable
    $(".draggable-item").draggable({
        cursor: "move",
        revert: "invalid",
    });

    // Make the container droppable
    $(".drag-container").droppable({
        accept: ".draggable-item",
        drop: function (event, ui) {
            // Get the dropped element
            const droppedItem = ui.draggable;
            const id = droppedItem.attr("id")

            const currentOrder = getPriorityOrderList()

            previousYObject[id] = droppedItem.offset().top
            const newOrder = getPriorityOrderList()
            const itemsIds = Object.values(newOrder)

            const payload = itemsIds.map((taskId, index) => {
                return {
                    taskId,
                    priority: index
                }
            })
            
            updateTaskPriority(
                payload,
                () => {
                    updateTaskOrderItem(itemsIds)
                },
                () => {
                    const currentItemsIds = Object.values(currentOrder)
                    updateTaskOrderItem(currentItemsIds)
                }
            )
        },
    });
});


function updateTaskPriority(payload, successCallback, errorCallback)
{
    _ajaxCall(
        `/api/bulk/tasks`,
        "PUT",
        payload,
        successCallback,
        errorCallback
    )
}

function _ajaxCall(url, method, payload, successCallback, errorCallback, props = {})
{
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    return $.ajax({
        url,
        method,
        data: JSON.stringify(payload),
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        success: function(response) {
            successCallback(response)
        },
        error: function(xhr, status, error) {
            errorCallback(xhr, status, error)
        },
        ...props
    })
}

function getPriorityOrderList()
{
    const order = {}
    for(let key in previousYObject) {
        const position = parseInt(previousYObject[key])
        if (order[position]) {
            order[+position+1] = key
        } else {
            order[position] = key
        }
    }

    return order
}

function updateTaskOrderItem(itemsIds)
{
    const containerData = []
    itemsIds.forEach(itemId => {
        containerData.push(
            $(`.drag-container .draggable-item#${itemId}`)
        )
    })

    $(".drag-container").empty()

    containerData.forEach(itemElement => {
        itemElement.removeAttr('style').css('position', 'relative')
        $(".drag-container").append(itemElement)
    })
    
    setTimeout(() => {
        $(".draggable-item").draggable({
            cursor: "move"
        })
    }, 1000)
}

$("#project-filter").change(function(e) {
    const val = $(this).val()
    window.location.href = `${window.location.origin}/tasks?projectId=${val}`
})