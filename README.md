# Translation

## Translator informations

We use crowdin (https://crowdin.com/project/atoum-documentation) and his client (https://crowdin.com/page/cli-tool)

### Usage
To send files:

	crowdin-cli upload source

To download the translations:

	crowdin-cli download

## Build the documentation

### Usage

	php builddoc

Or you can also use

	./builddoc

### Requirements

* Having sphinx installed (see http://sphinx-doc.org/install.html)
* Having php cli available
* Having crowdin-cli installed

