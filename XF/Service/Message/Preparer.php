<?php

namespace LiamW\MentionMiniAvatar\XF\Service\Message;

class Preparer extends XFCP_Preparer
{
	public function getEmbedMetadata()
	{
		$metadata = parent::getEmbedMetadata();

		$metadata['lwUserMentions'] = array_keys($this->getMentionedUsers());

		return $metadata;
	}
}