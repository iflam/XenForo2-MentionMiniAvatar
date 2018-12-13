<?php

namespace LiamW\MentionMiniAvatar\XF\Entity;

use LiamW\MentionMiniAvatar\Entity\MentionMiniAvatarTrait;
use XF\Mvc\Entity\Structure;

class ProfilePostComment extends XFCP_ProfilePostComment
{
	use MentionMiniAvatarTrait;

	public function getBbCodeRenderOptions($context, $type)
	{
		return $this->addMentionMiniAvatarBbCodeRenderOptions(parent::getBbCodeRenderOptions($context, $type));
	}

	public static function getStructure(Structure $structure)
	{
		return static::addMentionMiniAvatarStructureElements(parent::getStructure($structure));
	}
}