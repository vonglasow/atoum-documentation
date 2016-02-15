.. _stream-anchor:

stream
******

This is the assertion dedicated to the streams.

It's based on atoum virtual filesystem (VFS). A new `stream wrapper <http://php.net/streamWrapper>`_ will be registered (starting with ``atoum://``).

The mock will create a new file in the VFS and the steam path will be accessible via the ``getPath`` method on the stream controller (something like ``atoum://mockUniqId``).

.. _is-read:

isRead
======

``isRead`` checks if a mocked stream has been read.

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
   ``isWrited`` is an alias to the isWritten method.
   For more information, refer to the documentation of :ref:`stream::isWritten <is-written>`



