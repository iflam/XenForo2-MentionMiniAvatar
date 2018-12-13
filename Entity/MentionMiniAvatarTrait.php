<?php

namespace LiamW\MentionMiniAvatar\Entity;

use XF\Mvc\Entity\Structure;

trait MentionMiniAvatarTrait
{
	public function getLWUserMentions()
	{
		return isset($this->_getterCache['LWUserMentions']) ? $this->_getterCache['LWUserMentions'] : [];
	}

	public function setLWUserMentions($userMentions)
	{
		$this->_getterCache['LWUserMentions'] = $userMentions;
	}

	public static function addMentionMiniAvatarStructureElements(Structure $structure)
	{
		$structure->getters['LWUserMentions'] = true;

		return $structure;
	}

	public function addMentionMiniAvatarBbCodeRenderOptions(array $options)
	{
		$options['lwMentionedUsers'] = $this->LWUserMentions;

		return $options;
	}
}