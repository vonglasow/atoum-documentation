.. _stream-anchor:

stream
******

C'est l'assertion dédiée aux streams.

Elle est basée sur le système de fichier virtuel d'atoum (VFS). A new `stream wrapper <http://php.net/streamWrapper>`_ will be registered (starting with ``atoum://``).

Le bouchon va créer un nouveau fichier dans le VFS et le chemin du flux sera accessible en appellant la méthode ``getPath`` sur le controlleur de flux (par exemple ``atoum://mockUniqId``).

.. _is-read:

isRead
======

``isRead`` vérifie si le flux bouchoné à bien été lu.

.. code-block:: php

   <?
   $this
       ->given(
           $streamController = \atoum\mock\stream::get(),
           $streamController->file_get_contents = 'myFakeContent'
       )
       ->if(file_get_contents($streamController->getPath()))
       ->stream($streamController)
           ->isRead() // passe
   ;

   $this
       ->given(
           $streamController = \atoum\mock\stream::get(),
           $streamController->file_get_contents = 'myFakeContent'
       )
       ->if() // we do nothing
       ->stream($streamController)
           ->isRead() // fails
   ;


.. _is-written:

isWritten
=========

``isWritten`` checks if a mocked stream has been written.

.. code-block:: php

   <?
   $this
       ->given(
           $streamController = \atoum\mock\stream::get(),
           $streamController->file_put_contents = strlen($content = 'myTestContent')
       )
       ->if(file_put_contents($streamController->getPath(), $content))
       ->stream($streamController)
           ->isWritten() // passes
   ;

   $this
      ->given(
        $streamController = \atoum\mock\stream::get(),
        $streamController->file_put_contents = strlen($content = 'myTestContent')
      )
      ->if() // we do nothing
      ->stream($streamController)
         ->isWritten() // fails
   ;


.. _is-writed:

isWrited
========

.. hint::
   ``isWrited`` is an alias to the ``isWritten`` method.
   For more information, refer to the documentation of :ref:`stream::isWritten <is-written>`



