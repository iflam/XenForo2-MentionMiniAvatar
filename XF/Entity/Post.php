<?php

namespace LiamW\MentionMiniAvatar\XF\Entity;

use XF\Mvc\Entity\Structure;

class Post extends XFCP_Post
{
	public function getBbCodeRenderOptions($context, $type)
	{
		$options = parent::getBbCodeRenderOptions($context, $type);

		$options['lwMentionedUsers'] = $this->LWUserMentions;

		return $options;
	}

	public function getLWUserMentions()
	{
		return isset($this->_getterCache['LWUserMentions']) ? $this->_getterCache['LWUserMentions'] : [];
	}

	public function setLWUserMentions($userMentions)
	{
		$this->_getterCache['LWUserMentions'] = $userMentions;
	}

	public static function getStructure(Structure $structure)
	{
		$structure = parent::getStructure($structure);

		$structure->getters['LWUserMentions'] = true;

		return $structure;
	}
}