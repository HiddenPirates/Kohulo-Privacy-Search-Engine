$('#page_editor_textarea').richText({
	  // text formatting
	  bold: true,
	  italic: true,
	  underline: true,

	  // text alignment
	  leftAlign: true,
	  centerAlign: true,
	  rightAlign: true,
	  justify: true,

	  // lists
	  ol: true,
	  ul: true,

	  // title
	  heading: true,

	  // fonts
	  fonts: true,
	  fontList: ["Arial",
	    "Arial Black",
	    "Comic Sans MS",
	    "Courier New",
	    "Geneva",
	    "Georgia",
	    "Helvetica",
	    "Impact",
	    "Lucida Console",
	    "Tahoma",
	    "Times New Roman",
	    "Verdana"
	  ],
	  fontColor: true,
	  fontSize: true,

	  // uploads
	  imageUpload: true,
	  fileUpload: true,

	  // media <a href="https://www.jqueryscript.net/tags.php?/video/">video</a>Embed: true,

	  // link
	  urls: true,

	  // tables
	  table: true,

	  // code
	  removeStyles: true,
	  code: true,

	  // colors
	  colors: [],

	  // dropdowns
	  fileHTML: '',
	  imageHTML: '',

	  // translations
	  translations: {
	    'title': 'Title',
	    'white': 'White',
	    'black': 'Black',
	    'brown': 'Brown',
	    'beige': 'Beige',
	    'darkBlue': 'Dark Blue',
	    'blue': 'Blue',
	    'lightBlue': 'Light Blue',
	    'darkRed': 'Dark Red',
	    'red': 'Red',
	    'darkGreen': 'Dark Green',
	    'green': 'Green',
	    'purple': 'Purple',
	    'darkTurquois': 'Dark Turquois',
	    'turquois': 'Turquois',
	    'darkOrange': 'Dark Orange',
	    'orange': 'Orange',
	    'yellow': 'Yellow',
	    'imageURL': 'Image URL',
	    'fileURL': 'File URL',
	    'linkText': 'Link text',
	    'url': 'URL',
	    'size': 'Size',
	    'responsive': '<a href="https://www.jqueryscript.net/tags.php?/Responsive/">Responsive</a>',
	    'text': 'Text',
	    'openIn': 'Open in',
	    'sameTab': 'Same tab',
	    'newTab': 'New tab',
	    'align': 'Align',
	    'left': 'Left',
	    'justify': 'Justify',
	    'center': 'Center',
	    'right': 'Right',
	    'rows': 'Rows',
	    'columns': 'Columns',
	    'add': 'Add',
	    'pleaseEnterURL': 'Please enter an URL',
	    'videoURLnotSupported': 'Video URL not supported',
	    'pleaseSelectImage': 'Please select an image',
	    'pleaseSelectFile': 'Please select a file',
	    'bold': 'Bold',
	    'italic': 'Italic',
	    'underline': 'Underline',
	    'alignLeft': 'Align left',
	    'alignCenter': 'Align centered',
	    'alignRight': 'Align right',
	    'addOrderedList': 'Add ordered list',
	    'addUnorderedList': 'Add unordered list',
	    'addHeading': 'Add Heading/title',
	    'addFont': 'Add font',
	    'addFontColor': 'Add font color',
	    'addFontSize': 'Add font size',
	    'addImage': 'Add image',
	    'addVideo': 'Add video',
	    'addFile': 'Add file',
	    'addURL': 'Add URL',
	    'addTable': 'Add table',
	    'removeStyles': 'Remove styles',
	    'code': 'Show HTML code',
	    'undo': 'Undo',
	    'redo': 'Redo',
	    'close': 'Close'
	  },

	  // privacy
	  youtubeCookies: false,

	  // dev settings
	  useSingleQuotes: false,
	  height: 0,
	  heightPercentage: 0,
	  id: "",
	  class: "",
	  useParagraph: false,
	  maxlength: 0,

	  // callback function after init
	  callback: undefined
	});