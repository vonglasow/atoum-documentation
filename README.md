# Translation

## Translator informations

We use crowdin (https://crowdin.com/project/atoum-documentation) and his client (https://crowdin.com/page/cli-tool)

### Usage
To send files:

	crowdin-cli upload source

To download the translations:

	crowdin-cli download

## Adding new pages

1. Create the page, in french (french is the reference) or at lease create an issue to ask someone do it
1. This page must have a name related to his content and should be named in the spoken language
1. In *source/LANGUAGE/index.rst* file create the link to your new page
1. In *crowdin.yaml* file create the information about this page, to be ready to translate
1. Push the new page to crowdin

## Adding new Language

1. Create the new directory under *source/LANGUAGE*, where *LANGUAGE* is the two letter of the choosen language
1. In crowdin.yaml file add the new language for each translatation (under *languages_mapping*)
1. Push your tanslation to crowdin

## Build the documentation

### Usage

	php builddoc

Or you can also use

	./builddoc

### Requirements

* Having sphinx installed (see http://sphinx-doc.org/install.html)
* Having php cli available
* Having crowdin-cli installed

## F.A.Q.

### Why crowdin?
[Crowdin](https://crowdin.com/project/atoum-documentation) is an help to see the progression of the translation.
