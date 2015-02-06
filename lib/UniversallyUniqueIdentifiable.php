<?hh

namespace Herzen\Admission\Orm;

interface UniversallyUniqueIdentifiable {

    public function getUuid();

    public function setUuid($uuid);
}
