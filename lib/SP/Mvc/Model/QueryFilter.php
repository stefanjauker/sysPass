<?php
/**
 * sysPass
 *
 * @author    nuxsmin
 * @link      http://syspass.org
 * @copyright 2012-2018, Rubén Domínguez nuxsmin@$syspass.org
 *
 * This file is part of sysPass.
 *
 * sysPass is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * sysPass is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 *  along with sysPass.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace SP\Mvc\Model;

/**
 * Class QueryFilter
 *
 * @package SP\Mvc\Model
 */
class QueryFilter
{
    const FILTER_AND = ' AND ';
    const FILTER_OR = ' OR ';

    /**
     * @var array
     */
    protected $query = [];
    /**
     * @var array
     */
    protected $param = [];

    /**
     * @param $query
     * @param $params
     * @return QueryFilter
     */
    public function addFilter($query, array $params)
    {
        $this->query[] = $query;
        $this->param = array_merge($this->param, $params);

        return $this;
    }

    /**
     * @param string $type
     * @return string|null
     */
    public function getFilters($type = self::FILTER_AND)
    {
        if ($type !== self::FILTER_AND && $type !== self::FILTER_OR) {
            throw new \RuntimeException(__u('Tipo de filtro inválido'));
        }

        return $this->hasFilters() ? implode($type, $this->query) : null;
    }

    /**
     * @return bool
     */
    public function hasFilters()
    {
        return !empty($this->query);
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->param;
    }

    /**
     * @return int
     */
    public function getFiltersCount()
    {
        return count($this->query);
    }
}