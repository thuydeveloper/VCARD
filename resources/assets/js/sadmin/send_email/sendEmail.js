document.addEventListener("turbo:load", loadSendEmailData);
let descriptionData;

function loadSendEmailData() {
    Description();
    SelectCustomEmail();
};

function Description() {
    if(!$('#descriptionEditor').length){
        return false;
    }
    descriptionData = new Quill("#descriptionEditor", {
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                ["bold", "italic", "underline", "strike"],
                ["blockquote", "code-block"],
                [{ list: "ordered" }, { list: "bullet" }],
                [{ script: "sub" }, { script: "super" }],
                [{ indent: "-1" }, { indent: "+1" }],
                [{ direction: "rtl" }],
                [{ color: [] }, { background: [] }],
                [{ font: [] }],
                [{ align: [] }],
            ],
        },
        placeholder: Lang.get("js.send_email_description"),
        theme: "snow",
    });

    descriptionData.on("text-change", function (delta, oldDelta, source) {
        if (descriptionData.getText().trim().length === 0) {
            descriptionData.setContents([{ insert: "" }]);
        }
    });

    $("#emailForm").submit(function () {
        let editorContent = descriptionData.root.innerHTML;
        $("#sendEmailData").val(editorContent);
    });
}

function SelectCustomEmail() {
    $("#customEmailSelect").select2({
        tags: true,
        tokenSeparators: [',', ' '],
        sorter: addSelectAll,
    });
    $('#customEmailSelect').on('select2:select', handleSelection);
}

const addSelectAll = matches => {
    if (matches.length > 0) {
      return [
        {id: 'selectAll', text: 'Select All', matchIds: matches.map(match => match.id)},
        ...matches
      ];
    }
  };

let allSelected = false;

const handleSelection = event => {
    if (event.params.data.id === 'selectAll') {
        if (!allSelected) {
            $('#customEmailSelect').val(event.params.data.matchIds);
            $('#customEmailSelect').trigger('change');
            allSelected = true;
        } else {
            $('#customEmailSelect').val(null).trigger('change');
            allSelected = false;
        }
    }
};

listenSubmit('#emailForm', function (e) {
    e.preventDefault()
        if (descriptionData.getText().trim().length === 0) {
            displayErrorMessage(Lang.get("js.description_required"));
            return false;
        }
        if ($('#customEmailSelect').val() == '') {
            displayErrorMessage(Lang.get("js.select_email_required"));
            return false;
        }
        if ($('#subjectFiled').val().trim() == '') {
            displayErrorMessage(Lang.get("js.subject_required"));
            return false;
        }
        $('#emailForm')[0].submit();
})
